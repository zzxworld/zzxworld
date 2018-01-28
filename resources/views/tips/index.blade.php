@extends('layouts.app')

@section('title', '技巧 - zzxworld')

@section('content')
    <div class="container">
        <h1>技巧</h1>
        <a class="btn btn-primary" href="{{ url('tips/create') }}">分享技巧</a>
        <table class="table table-bordered table-hover">
            <tbody>
                @foreach ($tips as $tip)
                <tr>
                    <td>{{ $tip->text }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
