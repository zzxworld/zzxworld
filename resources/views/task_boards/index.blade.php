@extends('layouts.vue')
@section('title', '任务板 - zzxworld')

@push('head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush

@push('body')
    <script src="{{ asset_url('task_boards/app.js') }}"></script>
@endpush
