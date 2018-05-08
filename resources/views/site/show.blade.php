@extends('layouts.app')

@section('title', $site->name . ' | zzxworld')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1>{{ $site->name }}</h1>
                <div>
                    <a class="link" rel="external nofollow" target="_blank" href="{{ $site->url }}">{{ $site->url }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection
