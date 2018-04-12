<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\RssParser;
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
        $data = RssParser::parse($this->url);
        if (!$data) {
            return false;
        }

        if (isset($data['rss'])) {
            $items = static::formatRssData($data);
        } else {
            $items = static::formatAtomData($data);
        }

        $items = collect($items);

        $items = $items->map(function ($rs) {
            $rs['created_at'] = Carbon::parse($rs['created_at']);
            $rs['updated_at'] = Carbon::parse($rs['updated_at']);
            $rs['sign'] = md5($rs['url']);
            return $rs;
        });

        return $items;
    }

    public static function formatRssData($data)
    {
        $items = array_get($data, 'rss.channel.item');
        if (!$items) {
            return [];
        }

        foreach ($items as $i => $rs) {
            $items[$i] = [
                'title' => array_get($rs, 'title'),
                'url' => array_get($rs, 'link'),
                'content' => array_get($rs, 'description'),
                'created_at' => array_get($rs, 'pubDate'),
                'updated_at' => array_get($rs, 'pubDate'),
            ];
        }

        return $items;
    }

    public static function formatAtomData($data)
    {
        $items = array_get($data, 'feed.entry');
        if (!$items) {
            return [];
        }

        foreach ($items as $i => $rs) {
            $content = array_get($rs, 'content');
            if (isset($content['text'])) {
                $content = $content['text'];
            }

            $items[$i] = [
                'title' => array_get($rs, 'title'),
                'url' => array_get($rs, 'link._attr_href'),
                'content' => $content,
                'created_at' => array_get($rs, 'published'),
                'updated_at' => array_get($rs, 'updated'),
            ];
        }

        return $items;
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
                $post->saveText($rs['content']);
            }

            $exists->push($rs['sign']);
        }
    }
}
