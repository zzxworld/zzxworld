@extends('layouts.app')

@section('title', $site->name . ' | zzxworld')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                正在跳转到网站: <a class="link" rel="external nofollow" target="_blank" href="{{ $site->url }}">{{ $site->name }}</a>，请稍后...
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script charset="utf-8">
        location.href = "{{ $site->url }}";
    </script>
@endpush
