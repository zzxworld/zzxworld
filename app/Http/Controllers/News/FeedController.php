<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsFeed;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = NewsFeed::orderBy('updated_at', 'desc')->get();

        return view('news.feeds.index', ['feeds' => $feeds]);
    }

    public function create()
    {
        $feed = new NewsFeed;

        return view('news.feeds.create', ['feed' => $feed]);
    }

    public function store(Request $request)
    {
        $this->validate([
            'name' => 'required',
            'url' => 'required|url',
        ]);

        $feed = NewsFeed::create($request->all());

        return redirect('news/feeds');
    }

    public function edit(NewsFeed $feed)
    {
        return view('news.feeds.edit', ['feed' => $feed]);
    }

    public function update(NewsFeed $feed, Request $request)
    {
        $this->validate([
            'name' => 'required',
            'url' => 'required|url',
        ]);

        $feed->update($request->all());

        return redirect('news/feeds');
    }

    public function destory(NewsFeed $feed)
    {
        $feed->destroy();

        return redirect('news/feeds');
    }
}
