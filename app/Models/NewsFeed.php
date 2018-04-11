<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Requests;
use Carbon\Carbon;
use Log;

class NewsFeed extends Model
{
    protected $fillable = ['name', 'url'];

    public function posts()
    {
        return $this->hasMany('App\Models\NewsPost');
    }

    /**
     * 获取新闻源数据
     */
    public function fetch()
    {
        $response = Requests::get($this->url, [], [
            'timeout' => 60,
        ]);

        $xml = simplexml_load_string($response->body);
        $type = $xml->getName();

        if ($type == 'rss') {
            $items = static::parseRSS($xml);
        } else if ($type == 'feed') {
            $items = static::parseAtom($xml);
        } else {
            $items = collect();
        }

        $items = $items->map(function ($rs) {
            $rs['sign'] = md5($rs['url']);
            return $rs;
        });

        return $items;
    }

    /**
     * 解析 RSS 格式数据
     */
    public static function parseRSS(\SimpleXMLElement $xml)
    {
        $data = collect();

        $items = $xml->xpath('channel/item');
        foreach ($items as $item) {
            $item = (array) $item;

            $data->push([
                'title' => array_get($item, 'title'),
                'url' => array_get($item, 'link'),
                'created_at' => Carbon::parse(array_get($item, 'pubDate')),
                'author' => array_get($item, 'author'),
                'description' => array_get($item, 'description'),
            ]);
        }

        return $data;
    }

    /**
     * 解析 Atom 格式数据
     */
    public static function parseAtom(\SimpleXMLElement $xml)
    {
        $data = collect();

        $namespace = $xml->getNamespaces();
        $xml->registerXPathNamespace('c', array_values($namespace)[0]);

        $items = $xml->xpath('//c:entry');
        foreach ($items as $item) {
            $createdAt = strtotime((string) $item->published);
            if (!$createdAt) {
                continue;
            }

            $title = (string) $item->title;
            $url = (string) $item->link->xpath('@href')[0];
            $content = $item->content->xpath('./*')[0]->asXML();

            $data->push([
                'title' => $title,
                'url' => $url,
                'created_at' => date('Y-m-d H:i:s', $createdAt),
                'description' => $content,
            ]);
        }

        return $data;
    }

    /**
     * 获取并保存新闻源数据
     */
    public function fetchAndSave()
    {
        $items = $this->fetch();
        $exists = $this->posts()->whereIn('sign', $items->pluck('sign'))->pluck('sign');

        foreach ($items as $rs) {
            if ($exists->search($rs['sign']) !== false) {
                continue;
            }

            $rs['news_feed_id'] = $this->id;

            $post = NewsPost::create($rs);
            if ($post) {
                $post->saveText($rs['description']);
            }

            $exists->push($rs['sign']);
        }
    }
}
