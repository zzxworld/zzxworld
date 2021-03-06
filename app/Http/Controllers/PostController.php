<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('published_at', 'desc')->paginate(20);

        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts/create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $post = new Post($request->all());
        $post->published_at = date('Y-m-d H:i:s');
        $post->save();
        $post->saveText($request->input('content'));
        return redirect('posts/'.$post->id);
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', Post::class);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', Post::class);
        $post->update($request->all());
        $post->saveText($request->input('content'));
        return redirect(route('posts.show', $post));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', Post::class);
        $post->delete();
    }
}
