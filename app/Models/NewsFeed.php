<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Requests;
use Carbon\Carbon;

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
        $response = Requests::get($this->url);

        $xml = simplexml_load_string($response->body);
        if ($xml->getName() == 'rss') {
            $items = static::parseRSS($xml);
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
     * 获取并保存新闻源数据
     */
    public function fetchAndSave()
    {
        $items = $this->fetch();
        $exists = $this->posts()->whereIn('sign', $items->pluck('sign'))->pluck('sign');
        $items = $items->whereNotIn('sign', $exists);
        if ($items->count()) {
            $this->posts()->createMany($items->toArray());
        }
    }
}
