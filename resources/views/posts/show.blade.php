@extends('layouts/app')

@section('title', $post->title.' | zzxworld')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">{{ $post->title }}</h1>
                <span>{{ $post->published_at->format('Y-m-d') }}</span>
            </div>
            <div class="panel-body">
                {!! $post->html !!}
            </div>
            @if ($post->source_url)
            <div class="panel-footer">
                本文来源: <a href="{{ $post->source_url }}" rel="external nofollow" target="_blank">{{ $post->source_url_domain }}</a>
            </div>
            @endif
        </div>
    </div>
@endsection
