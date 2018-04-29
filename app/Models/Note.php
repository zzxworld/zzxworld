<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use \App\Models\Concerns\TextAble;

    const MORPH_NAME = 'NO';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
