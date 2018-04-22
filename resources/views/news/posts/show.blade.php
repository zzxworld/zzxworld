@extends('layouts/app')

@section('title', $post->title.' | zzxworld')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $post->title }}</h4>
                <span>{{ $post->created_at->format('Y-m-d') }}</span>
            </div>
            <div class="panel-body">{!! $post->content !!}</div>
            <div class="panel-footer">
                <span>来源: <a rel="external nofollow" target="_blank" href="{{ $post->url }}">{{ $post->feed ? $post->feed->name : $post->url }}</a></span>
            </div>
        </div>
    </div>

@endsection
