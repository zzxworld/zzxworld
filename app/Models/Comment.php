<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \App\Models\Concerns\TextAble;

    protected $fillable = ['user_id', 'ip'];
}
