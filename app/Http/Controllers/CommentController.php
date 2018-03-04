<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isJson()) {
            $comments = Comment::orderBy('id', 'desc')->paginate(50);
            return ['comments' => $comments];
        }
        return view('comments.index');
    }

    /**
     * 更新评论信息
     */
    public function update(Comment $comment, Request $request)
    {
        $comment->update($request->all());
        return ['message' => 'ok'];
    }

    /**
     * 删除评论
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return ['message' => 'ok'];
    }
}
