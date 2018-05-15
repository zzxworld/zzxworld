@extends('layouts/app')

@section('title', '网站 | zzxworld')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">网站</h4>
            </div>
            <ul class="list-group">
                @foreach ($sites as $site)
                    <li class="list-group-item site-item">
                        <a class="link" rel="external nofollow" target="_blank" href="{{ url('sites/'.$site->id.'/go') }}">{{ $site->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        {{ $sites->links() }}
    </div>

@endsection
