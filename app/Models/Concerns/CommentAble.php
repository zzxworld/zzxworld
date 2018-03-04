<?php

namespace App\Models\Concerns;

use App\Models\Comment;

trait CommentAble
{
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    /**
     * 获取有效的评论
     */
    public function getAvailableComments(User $user = null, string $ip = null)
    {
        return $this->comments->filter(function ($comment) use ($user, $ip) {
            // 没有隐藏属性
            if (!$comment->is_hidden) {
                return true;
            }

            // 注册用户自己发表的
            if ($user && $comment->user_id == $user->id) {
                return true;
            }

            // 匿名用户自己发表的
            if ($comment->ip == $ip) {
                return true;
            }

            return false;
        });
    }
}
