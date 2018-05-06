<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use Concerns\Taggable;

    const MORPH_NAME = 'SI';

    protected $fillable = ['url', 'name'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($site) {
            $site->uuid = static::buildUUID($site->url);
        });
    }

    public static function buildUUID(string $url)
    {
        return md5($url);
    }

    public static function isExist(string $url)
    {
        return (bool) static::where('uuid', static::buildUUID($url))->count();
    }

    /**
     * 删除站点
     */
    public function delete()
    {
        $this->tags()->delete();
        parent::delete();
    }
}
