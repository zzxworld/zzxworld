<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    use \App\Models\Concerns\TextAble;

    protected $fillable = ['news_feed_id', 'is_disabled', 'sign', 'title', 'url', 'created_at'];

    public function feed()
    {
        return $this->belongsTo('App\Models\NewsFeed', 'news_feed_id');
    }

    public function getContentAttribute()
    {
        $content = $this->text;

        $content = preg_replace('/href="(.+)"/iU', 'rel="external nofollow" target="_blank" href="\1"', $content);

        return $content;
    }
}
