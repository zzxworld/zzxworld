<?php

namespace App\Models\Concerns;

use App\Models\Text;

trait TextAble
{
    public function texts()
    {
        return $this->morphMany('App\Models\Text', 'textable');
    }

    /**
     * 保存文本内容
     */
    public function saveText(string $content)
    {
        $this->texts()->create([
            'text' => $content,
        ]);
    }

    /**
     * 获取文本内容
     */
    public function getTextAttribute()
    {
        return $this->texts->pluck('text')->implode('');
    }
}
