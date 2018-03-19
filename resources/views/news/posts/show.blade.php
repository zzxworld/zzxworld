@extends('layouts/app')

@section('title', $post->title.' | zzxworld')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $post->title }}</h4>
            </div>
            <div class="panel-body"></div>
            <div class="panel-footer">
                <span>来源: <a href="{{ $post->url }}" target="_blank">{{ $post->url }}</a></span>
            </div>
        </div>
    </div>

@endsection
