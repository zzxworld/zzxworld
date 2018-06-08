@extends('layouts.base')

@section('title', '笔记本 - zzxworld')

@section('content')
    <div id="notebook">
        <main id="notebook-content">
            <v-editor v-model="note.content" placeholder="记点什么..."></v-editor>
        </main>
    </div>
@endsection

@push('head')
    <link href="{{ asset('css/notebooks.css') }}" rel="stylesheet">
@endpush

@push('bottom')
    <script src="{{ asset('js/notes/notebooks.js') }}"></script>
@endpush
