<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteFeed extends Model
{
    protected $fillable = ['title', 'url'];

    public function site()
    {
        return $this->belongsTo('App\Models\Site');
    }
}
