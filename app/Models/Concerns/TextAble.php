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
    public function saveText(string $content, $keepVersion=false)
    {
        $version = md5($content);
        $exists = $this->texts()->where('version', $version)->count();
        if ($exists) {
            return;
        }

        if (!$keepVersion) {
            $this->texts()->delete();
        }

        $data = [];
        $segments = Text::segment($content);
        foreach ($segments as $segment) {
            $data[] = [
                'version' => $version,
                'text' => $segment,
            ];
        }

        $this->texts()->createMany($data);
    }

    /**
     * 获取文本内容
     */
    public function getTextAttribute()
    {
        return $this->texts->pluck('text')->implode('');
    }
}
