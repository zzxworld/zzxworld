<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsPost;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = NewsPost::where('is_disabled', false)->orderBy('created_at', 'desc')->paginate(50);

        return view('news.posts.index', ['posts' => $posts]);
    }

    public function update(Request $request, NewsPost $news)
    {
        $this->authorize('update', $news);

        $news->update($request->all());

        return ['message' => 'ok'];
    }

    public function show(NewsPost $news)
    {
        if ($news->is_disabled) {
            abort(404);
        }
        return view('news.posts.show', ['post' => $news]);
    }
}
