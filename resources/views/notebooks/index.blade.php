@extends('layouts.base')

@section('title', '笔记本 - zzxworld')

@section('content')
    <div id="notebook">
        <main id="notebook-content">
            <v-editor v-model="note.content" placeholder="记点什么..."></v-editor>
        </main>
        <footer id="notebook-footer">
            <nav>
                <div class="menu btn-list btn-group dropup" ref="navList" v-if="notes.length > 1">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="笔记列表"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                    <v-notebook-list :notes="notes" @select="select"></v-notebook-list>
                </div>
                <button class="menu btn btn-default" title="新的笔记" @click="add">
                    <span class="glyphicon glyphicon-file"></span>
                </button>
                <button class="menu btn btn-default" title="保存到服务端" @click="saveToServer" v-if="isLogined">
                    <span class="glyphicon glyphicon-floppy-disk"></span>
                </button>
            </nav>
        </footer>
    </div>
@endsection

@push('head')
    <link href="{{ asset('css/notebooks.css') }}" rel="stylesheet">
@endpush

@push('bottom')
    <script src="{{ asset('js/notebooks.js') }}"></script>
@endpush
