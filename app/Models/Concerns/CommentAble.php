<?php

namespace App\Models\Concerns;

use App\Models\Comment;

trait CommentAble
{
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
