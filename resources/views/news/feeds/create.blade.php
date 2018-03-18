@extends('layouts/app')

@section('title', '新增新闻源')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">新增新闻源</h2>
            </div>
            <div class="panel-body">
                <form action="{{ url('news/feeds') }}" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>名称</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label>地址</label>
                        <input class="form-control" type="text" name="url">
                    </div>
                    <button class="btn btn-primary" type="submit">保存</button>
                </form>
            </div>
        </div>
    </div>

@endsection
