<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    return $this->morphMany('App\Text', 'textable');
}
