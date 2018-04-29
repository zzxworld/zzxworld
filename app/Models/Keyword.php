<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['text', 'is_manual'];

    public function setTextAttribute($value)
    {
        $this->attributes['text'] = mb_substr($value, 0, 255);
    }
}
