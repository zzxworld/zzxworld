<?php

namespace App\Models\Concerns;

trait Taggable
{
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
}
