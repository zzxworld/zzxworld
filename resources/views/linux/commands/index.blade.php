@extends('layouts/app')

@section('title', 'Linux 终端常用命令大全 | zzxworld')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Linux 命令大全</h1>
            </div>
            <div class="panel-body">
                <div class="row">
                @foreach ($commands as $command)
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <code><a href="{{ url('linux/commands/'.$command->name) }}">{{ $command->name }}</a></code>
                        <p>{{ $command->effect }}</p>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
