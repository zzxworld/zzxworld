@extends('layouts.app')

@section('title', '评论管理')

@section('content')

    <div class="container-fluid">
        <div class="panel panel-default">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th width="150">Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="comment in comments">
                        <td>@{{ comment.id }}</td>
                        <td>@{{ comment.name }}</td>
                        <td>@{{ comment.email }}</td>
                        <td>
                            <div>
                                <span class="label label-primary">@{{ comment.commentable_type }} : @{{ comment.commentable_id }}</span>
                            </div>
                            @{{ comment.text }}
                        </td>
                        <td>@{{ comment.created_at }}</td>
                        <td>
                            <a href="javascript:;" class="btn btn-success btn-xs" v-if="!comment.is_hidden" @click="toggleHidden(comment)">Public</a>
                            <a href="javascript:;" class="btn btn-warning btn-xs" v-if="comment.is_hidden" @click="toggleHidden(comment)">Hidden</a>
                            <a href="javascript:;" class="btn btn-danger btn-xs" @click="del(comment)">Remove</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('js')

    <script charset="utf-8">
        $(function () {
            $.ajaxSetup({
                dataType: 'json',
                contentType: 'application/json',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });

            var app = new Vue({
                el: '#app-page',

                data: {
                    comments: [],
                },

                methods: {
                    loadList: function () {
                        $.get('comments', function (response) {
                            app.comments = response.comments.data;
                        });
                    },

                    del: function (comment) {
                        swal({
                            title: '操作确认',
                            text: '确定要删除此评论吗?',
                            buttons: ['取消', '确定'],
                            dangerMode: true,
                        }).then(function (confirmed) {
                            if (!confirmed) {
                                return false;
                            }
                            $.ajax({
                                url: 'comments/'+comment.id,
                                type: 'DELETE',
                                success: function (response) {
                                    app.loadList();
                                },
                            });
                        });
                    },

                    toggleHidden: function (comment) {
                        $.ajax({
                            url: 'comments/'+comment.id,
                            type: 'PUT',
                            data: JSON.stringify({
                                is_hidden: !comment.is_hidden,
                            }),
                            success: function (response) {
                                app.loadList();
                            }
                        });
                    },
                },

                mounted: function () {
                    this.loadList();
                }
            });
        });
    </script>

@endpush
