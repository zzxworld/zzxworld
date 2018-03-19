<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsPost;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = NewsPost::orderBy('updated_at', 'desc')->paginate(50);

        return view('news.posts.index', ['posts' => $posts]);
    }

    public function show(NewsPost $news)
    {
        return view('news.posts.show', ['post' => $news]);
    }
}
