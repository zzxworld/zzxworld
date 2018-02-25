<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Post extends Model
{
    use \App\Models\Concerns\TextAble;
    use \App\Models\Concerns\CommentAble;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * 获取 html 格式的内容
     */
    public function getHtmlAttribute()
    {
        return Parsedown::instance()->text($this->text);
    }

    /**
     * 获取来源链接域名
     */
    public function getSourceURLDomainAttribute()
    {
        return parse_url($this->source_url, PHP_URL_HOST);
    }
}
