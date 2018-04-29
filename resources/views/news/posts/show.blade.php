@extends('layouts/app')

@section('title', $post->title.' | zzxworld')

@section('content')

    <div class="container">
        <div class="news-post panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $post->title }}</h4>
                <span>{{ $post->created_at->format('Y-m-d') }}</span>
            </div>
            <div class="panel-body">{!! $post->content !!}</div>
            <footer class="panel-footer">
                <span>来源: <a rel="external nofollow" target="_blank" href="{{ $post->url }}">{{ $post->feed ? $post->feed->name : $post->url }}</a></span>

                <div class="tags">
                @foreach ($post->getKeywordsWithTFIDF(10) as $keyword)
                    <span class="label label-default">{{ $keyword->text }}</span>
                @endforeach
                </div>
            </footer>
        </div>
    </div>

@endsection
