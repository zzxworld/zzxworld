<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 文本数据模型
 */
class Text extends Model
{
    public function textable()
    {
        return $this->morphTo();
    }
}
