<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * URL 变更
 */
class URLAlteration extends Model
{
    protected $table = 'url_alterations';
    protected $fillable = ['from', 'to', 'is_permanent'];

    /**
     * 获取地址变更的 HTTP 响应代码
     */
    public function getHTTPCodeAttribute()
    {
        return ($this->is_permanent) ? 301 : 302;
    }
}
