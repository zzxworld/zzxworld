<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 文本数据模型
 */
class Text extends Model
{
    protected $fillable = ['version', 'text'];

    public function textable()
    {
        return $this->morphTo();
    }

    /**
     * 按指定字数切分文本内容
     */
    public static function segment($content, $limit=1023)
    {
        $segments = collect();
        $total = ceil(mb_strlen($content)/$limit);
        foreach (range(0, $total-1) as $pos) {
            $segments->push(mb_substr($content, $pos*$limit, $limit));
        }
        return $segments;
    }
}
