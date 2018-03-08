<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\LinuxCommand;

class HomeController extends Controller
{
    public function index()
    {
        $linuxCommands = LinuxCommand::orderBy('published_at', 'desc')->limit(12)->get();
        $posts = Post::orderBy('published_at', 'desc')->paginate(20);

        return view('home.index', [
            'posts' => $posts,
            'linuxCommands' => $linuxCommands,
        ]);
    }
}
