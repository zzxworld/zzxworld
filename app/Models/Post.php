<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Post extends Model
{
    use \App\Models\Concerns\TextAble;

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
}
