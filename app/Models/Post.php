<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \App\Models\Concerns\TextAble;

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
