@extends('layouts/app')

@section('title', 'Linux '.$command->name.' 命令用法详解')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h1 class="panel-title">Linux <code>{{ $command->name }}</code> 命令</h1></div>
            <div class="panel-body">{!! $command->html !!}</div>
        </div>
    </div>

@endsection
