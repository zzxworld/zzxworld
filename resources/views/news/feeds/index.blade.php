@extends('layouts.app')

@section('title', '新闻源')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">新闻源</h2>
                <a href="{{ url('news/feeds/create') }}">新增</a>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feeds as $feed)
                    <tr>
                        <td>{{ $feed->id }}</td>
                        <td>{{ $feed->name }}</td>
                        <td>{{ $feed->url }}</td>
                        <td>{{ $feed->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ url('news/feeds/'.$feed->id.'/edit') }}">编辑</a>
                            <a href="javascript:;" onclick="deleteWith('{{ url('news/feeds/'.$feed->id) }}')">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
