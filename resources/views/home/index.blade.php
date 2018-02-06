@extends('layouts/app')

@section('title', '首页 | zzxworld')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <ul class="list-group">
                @foreach ($posts as $post)
                    <li class="list-group-item">
                        <a href="{{ url('posts/'.$post->id) }}">{{ $post->title }}</a>
                        <span>{{ $post->published_at->format('Y-m-d') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
