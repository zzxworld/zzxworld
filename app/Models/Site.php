<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use Concerns\Taggable;

    const MORPH_NAME = 'SI';

    protected $fillable = ['is_private', 'scheme', 'domain', 'port', 'path', 'name'];

    /**
     * 站点详情
     */
    public function detail()
    {
        return $this->hasOne('App\Models\SiteDetail');
    }

    /**
     * 站点链接
     */
    public function getURLAttribute()
    {
        $url = $this->scheme.'://'.$this->domain;

        if ($this->port != 80) {
            $url .= ':'.$this->port;
        }

        if ($this->path) {
            $url .= '/'.$this->path;
        }

        return $url;
    }

    /**
     * 删除站点
     */
    public function delete()
    {
        $this->tags()->detach();
        $this->detail()->delete();

        parent::delete();
    }
}
