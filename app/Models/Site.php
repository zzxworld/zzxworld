<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Support\SiteParse;

class Site extends Model
{
    use Concerns\Taggable;

    const MORPH_NAME = 'SI';

    protected $fillable = ['is_private', 'name'];
    protected $appends = ['url'];

    /**
     * 站点详情
     */
    public function detail()
    {
        return $this->hasOne('App\Models\SiteDetail');
    }

    /**
     * 设置网站链接
     */
    public function setURLAttribute($value)
    {
        $this->attributes['scheme'] = SiteParse::extractURLScheme($value);
        $this->attributes['domain'] = SiteParse::extractURLDomain($value);
    }

    /**
     * 获取站点链接
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
     * 站点图标
     */
    public function getIconAttribute()
    {
        if (!$this->detail || !$this->detail->icon) {
            return;
        }

        return $this->detail->icon;
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
