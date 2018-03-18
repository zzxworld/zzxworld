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
        // $response = Requests::get($this->url);
        // var_dump(simplexml_load_string($response->body));

        $xml = simplexml_load_string(file_get_contents('/Users/zzxworld/Desktop/feed.xml'));
        if ($xml->getName() == 'rss') {
            return static::parseRSS($xml);
        }
    }

    /**
     * 获取并保存新闻源数据
     */
    public function fetchAndSave()
    {
        $items = (array) $this->fetch();
        $this->posts()->createMany($items);
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
}
