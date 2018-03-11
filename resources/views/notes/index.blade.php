@extends('layouts.note')

@section('title', '笔记本 - zzxworld')

@section('content')
    <div class="container">
        <div class="content-header">
            @guest

            @else
                <button class="btn btn-primary" type="button" @click="save">保存</button>
            @endguest

            <button class="btn btn-default" type="button">预览</button>
        </div>
        <div class="panel panel-default" id="editor-container">
            <textarea class="editor" v-model="note.content"></textarea>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/note.js') }}"></script>
@endpush
