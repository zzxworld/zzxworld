<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('published_at', 'desc')->paginate(20);

        return view('home.index', [
            'posts' => $posts
        ]);
    }
}
