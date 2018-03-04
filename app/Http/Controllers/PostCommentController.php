<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $rules = [
            'content' => 'required',
        ];

        $user = $request->user();
        if (!$user) {
            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
        }

        $this->validate($request, $rules);

        $comment = $post->comments()->create([
            'user_id' => $request->user() ? $request->user()->id : 0,
            'guest_name' => $request->input('name'),
            'guest_email' => $request->input('email'),
            'ip' => $request->ip(),
        ]);

        $comment->saveText($request->input('content'));

        return redirect('posts/'.$post->id.'#comment-'.$comment->id);
    }
}
