@extends('layouts/app')

@section('title', $post->title.' | zzxworld')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $post->title }}</h4>
                <span>{{ $post->created_at->format('Y-m-d') }}</span>
            </div>
            <div class="panel-body">{!! $post->text !!}</div>
            <div class="panel-footer">
                <span>来源: <a href="{{ $post->url }}" target="_blank">{{ $post->feed->name }}</a></span>
            </div>
        </div>
    </div>

@endsection
