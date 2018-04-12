@extends('layouts/app')

@section('title', '头条 | zzxworld')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">头条</h4>
            </div>
            <ul class="list-group">
                @foreach ($posts as $post)
                    <li class="list-group-item">
                        <a rel="nofollow" href="{{ url('news/'.$post->id) }}">{{ $post->title }}</a>
                        <span>{{ $post->created_at->format('Y-m-d') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        {{ $posts->links() }}
    </div>

@endsection
