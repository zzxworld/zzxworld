<?php

namespace App\Models\Concerns;

use App\Models\Comment;
use App\Models\User;

trait Taggable
{
    public function tags()
    {
        return $this->morphMany('App\Models\Tag', 'taggable');
    }
}
