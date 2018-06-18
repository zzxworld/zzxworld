@extends('layouts.vue')

@section('title', '笔记本 - zzxworld')

@push('head')
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
@endpush

@push('body')
    <script src="{{ asset_url('notes/notebook/app.js') }}"></script>
@endpush
