<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \App\Models\Concerns\TextAble;

    protected $fillable = ['user_id', 'ip', 'guest_name', 'guest_email', 'is_hidden'];
    protected $appends = ['name', 'email', 'text'];

    /**
     * 获取评论用户姓名
     */
    public function getNameAttribute()
    {
        if ($this->user_id) {

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

        } else {
            return $this->guest_email;
        }
    }
}
