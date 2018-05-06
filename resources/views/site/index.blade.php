@extends('layouts/app')

@section('title', '网站 | zzxworld')

@push('css')
    <style>
        .site-item .link {
            color: #999;
            font-size: 0.9em;
            margin-left: 1em;
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
                        <a class="name" href="{{ url('sites/'.$site->id) }}">{{ $site->name }}</a>
                        <a class="link" rel="external nofollow" target="_blank" href="{{ $site->url }}">{{ $site->url }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        {{ $sites->links() }}
    </div>

@endsection
