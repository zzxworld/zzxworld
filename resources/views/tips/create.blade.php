@extends('layouts.app')

@section('title', '分享技巧 - zzxworld')

@section('content')

    <div class="container">
        <h1>分享技巧</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('tips') }}" method="post" accept-charset="utf-8">
            {{ csrf_field() }}
            <div class="form-group">
                <label>技巧内容</label>
                <textarea class="form-control" name="content" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">发表</button>
        </form>
    </div>

@endsection
