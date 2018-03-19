<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    use \App\Models\Concerns\TextAble;

    protected $fillable = ['news_feed_id', 'sign', 'title', 'url', 'created_at'];

    public function feed()
    {
        return $this->belongsTo('App\Models\NewsFeed', 'news_feed_id');
    }
}
