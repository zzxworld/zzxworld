<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class URLAlteration extends Model
{
    protected $table = 'url_alterations';
    protected $fillable = ['from', 'to', 'is_permanent'];
}
