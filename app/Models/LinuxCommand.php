<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class LinuxCommand extends Model
{
    use Concerns\TextAble;
    use \App\Models\Concerns\CommentAble;

    const MORPH_NAME = 'LC';

    /**
     * 自定义路由 id 字段
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * 获取 html 格式的内容
     */
    public function getHtmlAttribute()
    {
        return Parsedown::instance()->text($this->text);
    }
}
