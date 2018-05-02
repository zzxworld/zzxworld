@extends('layouts.admin')

@section('title', '站点管理')

@section('content')
    <site-list></site-list>
@endsection

@push('js')
    <script charset="utf-8" src="{{ url('js/site/admin_index.js') }}"></script>
@endpush
