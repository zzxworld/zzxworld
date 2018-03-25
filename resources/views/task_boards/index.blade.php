@extends('layouts.base')
@section('title', '任务板 - zzxworld')

@push('head')
    <link href="{{ asset('css/task_boards.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div id="app">
        <div class="container">
            <v-new-task @add="add"></v-new-task>
            <div class="row">
                <div class="col-sm-4">
                    <v-task-block name="pending" title="准备做" :items="pendingList"></v-task-block>
                </div>
                <div class="col-sm-4">
                    <v-task-block name="doing" title="正在做" :items="doingList"></v-task-block>
                </div>
                <div class="col-sm-4">
                    <v-task-block name="finish" title="完成了" :items="finishList" :enable-clear-button="true" @clear="finishList=[]"></v-task-block>
                </div>
            </div>
        </div>
        <footer id="page-footer">
            <div class="container">
                <ul>
                    <li><a href="javascript:;" @click="openHelpWindow=true">使用帮助</a></li>
                    <li><a href="/">zzxworld</a></li>
                </ul>
            </div>
        </footer>
        <v-window title="任务板使用帮助" v-open-if="openHelpWindow" @close="openHelpWindow=false">
            <ul>
                <li>在顶部的输入框中输入准备做的任务。</li>
                <li>通过拖放操作可调整任务的位置和不同状态。</li>
                <li>任务数据使用使用浏览器的本地存储功能保存。</li>
                <li>完成状态的任务可以进行清除操作。</li>
            </ul>
        </v-window>
    </div>
@endsection

@push('bottom')
    <script src="{{ asset('js/task_boards.js') }}"></script>
@endpush
