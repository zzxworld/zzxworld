<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use Concerns\Taggable;

    const MORPH_NAME = 'SI';

    protected $fillable = ['scheme', 'domain', 'name'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($site) {
            $site->uuid = static::buildUUID($site->url);
        });
    }

    /**
     * 站点详情
     */
    public function detail()
    {
        return $this->hasOne('App\Models\SiteDetail');
    }

    /**
     * 删除站点
     */
    public function delete()
    {
        $this->tags()->detach();
        parent::delete();
    }
}
