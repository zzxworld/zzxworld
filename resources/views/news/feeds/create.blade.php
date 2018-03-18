@extends('layouts/app')

@section('title', '新增新闻源')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">新增新闻源</h2>
            </div>
            <div class="panel-body">
                @include('news/feeds/components/form', [
                    'url' => 'news/feeds',
                    'feed' => $feed,
                ])
            </div>
        </div>
    </div>

@endsection
