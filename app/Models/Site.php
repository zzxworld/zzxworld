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
     * 删除站点
     */
    public function delete()
    {
        $this->tags()->detach();
        $this->detail()->delete();

        parent::delete();
    }
}
