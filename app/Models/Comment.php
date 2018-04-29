<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \App\Models\Concerns\TextAble;

    const MORPH_NAME = 'CO';

    protected $fillable = ['user_id', 'ip', 'guest_name', 'guest_email', 'is_hidden'];
    protected $appends = ['name', 'email', 'text'];

    /**
     * 评论用户
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * 获取评论用户姓名
     */
    public function getNameAttribute()
    {
        if ($this->user_id) {
            return $this->user->name;
        } else {
            return $this->guest_name;
        }
    }

    /**
     * 获取评论用户联系邮箱
     */
    public function getEmailAttribute()
    {
        if ($this->user_id) {
            return $this->user->email;
        } else {
            return $this->guest_email;
        }
    }
}
