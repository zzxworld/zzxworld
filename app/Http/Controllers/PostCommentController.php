<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $comment = $post->comments()->create([
            'user_id' => $request->user() ? $request->user()->id : 0,
            'ip' => $request->ip(),
        ]);

        $comment->saveText($request->input('content'));

        return redirect('posts/'.$post->id);
    }
}
