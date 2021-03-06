@extends('layouts/app')

@section('title', '编辑文章 | zzxworld')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h2 class="panel-title">编辑文章</h2></div>
            <div class="panel-body">
                <form action="{{ route('posts.update', $post) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>标题</label>
                        <input class="form-control" type="text" name="title" value="{{ $post->title }}">
                    </div>
                    <div class="form-group">
                        <label>来源地址</label>
                        <input class="form-control" type="text" name="source_url" value="{{ $post->source_url }}">
                    </div>
                    <div class="form-group">
                        <label>内容</label>
                        <textarea class="form-control" rows="20" name="content">{{ $post->text }}</textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">保存</button>
                </form>
            </div>
        </div>
    </div>

@endsection
