@extends('layouts.base')

@section('title', '笔记本 - zzxworld')

@section('content')
    <div id="app">
        <div class="container">
            <div class="panel panel-default" id="editor-container">
                <v-editor></v-editor>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <link href="{{ asset('css/notebooks.css') }}" rel="stylesheet">
@endpush

@push('bottom')
    <script src="{{ asset('js/notebooks.js') }}"></script>
@endpush
