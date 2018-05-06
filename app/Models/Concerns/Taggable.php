<?php

namespace App\Models\Concerns;

trait Taggable
{
    public function tags()
    {
        return $this->morphMany('App\Models\Tag', 'taggable');
    }
}
