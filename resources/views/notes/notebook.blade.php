@extends('layouts.vue')

@section('title', '笔记本 - zzxworld')

@push('head')
    <link href="{{ mix('css/notes/notebook.css') }}" rel="stylesheet">
@endpush

@push('body')
    <script src="{{ mix('js/notes/notebook/app.js') }}"></script>
@endpush
