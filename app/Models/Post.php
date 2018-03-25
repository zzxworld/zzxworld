<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Post extends Model
{
    use \App\Models\Concerns\TextAble;
    use \App\Models\Concerns\CommentAble;

    protected $fillable = ['title', 'source_url'];
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * 获取 html 格式的内容
     */
    public function getHtmlAttribute()
    {
        $content = Parsedown::instance()->text($this->text);
        $content = preg_replace('/href="(http.+)"/iU', 'rel="external nofollow" target="_blank" href="\1"', $content);
        return $content;
    }

    /**
     * 获取来源链接域名
     */
    public function getSourceURLDomainAttribute()
    {
        return parse_url($this->source_url, PHP_URL_HOST);
    }
}
