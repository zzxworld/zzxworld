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
        </div>
    </div>
@endsection
