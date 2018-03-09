@extends('layouts.note')

@section('title', '笔记本 - zzxworld')

@section('content')
    <div class="container">
        <div class="panel panel-default" id="editor-container">
            <textarea class="editor" v-model="note.content"></textarea>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/note.js') }}"></script>
@endpush
