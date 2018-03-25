@extends('layouts/app')

@section('title', '首页 | zzxworld')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Linux 命令</h2>
            </div>
            <div class="row">
                @foreach ($linuxCommands as $command)
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="linux-command">
                            <h4><a href="{{ url('linux/commands/'.$command->name) }}">{{ $command->name }}</a></h4>
                            <p>{{ $command->effect }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2 class="panel-title">头条</h2></div>
                    <ul class="list-group">
                        @foreach ($news as $post)
                            <li class="list-group-item">
                                <a href="{{ url('news/'.$post->id) }}">{{ $post->title }}</a>
                                <span>{{ $post->created_at->format('Y-m-d') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2 class="panel-title">文章</h2></div>
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
        </div>
    </div>
@endsection
