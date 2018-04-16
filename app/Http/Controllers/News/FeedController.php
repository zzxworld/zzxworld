<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsFeed;

class FeedController extends Controller
{
    public function index()
    {
        $this->authorize('view', NewsFeed::class);

        $feeds = NewsFeed::orderBy('updated_at', 'desc')->withCount('posts')->get();

        return view('news.feeds.index', ['feeds' => $feeds]);
    }

    public function create()
    {
        $this->authorize('create', NewsFeed::class);

        $feed = new NewsFeed;

        return view('news.feeds.create', ['feed' => $feed]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', NewsFeed::class);

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
        ]);

        $feed = NewsFeed::create($request->all());

        return redirect('news/feeds');
    }

    public function edit(NewsFeed $feed)
    {
        $this->authorize('update', $feed);

        return view('news.feeds.edit', ['feed' => $feed]);
    }

    public function update(NewsFeed $feed, Request $request)
    {
        $this->authorize('update', $feed);

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
        ]);

        $feed->update($request->all());

        return redirect('news/feeds');
    }

    public function destroy(NewsFeed $feed)
    {
        $this->authorize('delete', $feed);

        $feed->delete();

        return ['message' => 'ok'];
    }
}
