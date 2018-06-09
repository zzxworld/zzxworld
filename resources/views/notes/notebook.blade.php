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
    <link href="{{ mix('css/notes/notebook.css') }}" rel="stylesheet">
@endpush

@push('bottom')
    <script src="{{ mix('js/notes/notebook/app.js') }}"></script>
@endpush
