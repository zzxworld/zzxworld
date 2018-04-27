@extends('layouts.app')

@section('title', '文本分词工具 - zzxworld')

@section('content')
    <div class="container" id="app">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control" placeholder="输入要分词的文本..." rows="10" v-model="content"></textarea>
                </div>
                <button class="btn btn-primary" type="button" @click="submit">开始分词</button>
                <div class="words">
                    <template v-for="word in words">
                        <span class="label label-default">@{{ word.text }}<i>@{{ word.count }}</i></span>
                    </template>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style type="text/css" media="screen">
        .words {
            margin-top: 1em;
        }

        .words .label {
            display: inline-block;
            margin-right: 0.5em;
        }

        .words .label i {
            border-left: 1px dashed #999;
            display: inline-block;
            background: #666;
            padding: 0.3em 0.5em;
            margin: -0.2em -0.6em -0.3em 0.5em;
            border-radius: 0 0.25em 0.25em 0;
        }
    </style>
@endpush

@push('js')
    <script charset="utf-8" src="{{ url('js/tool/segmentword.js') }}"></script>
@endpush
