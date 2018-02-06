<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('published_at', 'desc')->limit(20)->get();

        return view('home.index', [
            'posts' => $posts
        ]);
    }
}
