<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteDetail extends Model
{
    protected $fillable = ['title', 'icon'];

    /**
     * 站点详情
     */
    public function site()
    {
        return $this->belongsTo('App\Models\Site');
    }
}
