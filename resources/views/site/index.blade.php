@extends('layouts/app')

@section('title', '网站 | zzxworld')

@push('css')
    <style type="text/css" media="screen">
        .site-item .https {
            color: #090;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">网站</h4>
            </div>
            <ul class="list-group">
                @foreach ($sites as $site)
                    <li class="list-group-item site-item">
                        @if ($site->icon)
                            <img src="{{ $site->icon }}" alt="{{ $site->name }} Icon">
                        @endif

                        @if ($site->scheme == 'https')
                            <span class="glyphicon glyphicon-lock https"></span>
                        @endif
                        <a class="link" rel="external nofollow" target="_blank" href="{{ url('sites/'.$site->id.'/go') }}">{{ $site->name ? $site->name : $site->title }}</a>
                        @foreach ($site->tags as $tag)
                            <a class="label label-default" href="{{ url('sites/tags/'.$tag->id) }}">{{ $tag->name }}</a>
                        @endforeach
                    </li>
                @endforeach
            </ul>
        </div>
        {{ $sites->links() }}
    </div>
@endsection
