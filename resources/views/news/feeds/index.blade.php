@extends('layouts.app')

@section('title', '新闻源')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">新闻源</h2>
                <a href="{{ url('news/feeds/create') }}">新增</a>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feeds as $feed)
                    <tr>
                        <td>{{ $feed->id }}</td>
                        <td>{{ $feed->name }}</td>
                        <td>{{ $feed->url }}</td>
                        <td>{{ $feed->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ url('news/feeds/'.$feed->id.'/edit') }}">编辑</a>
                            <a href="javascript:;" class="btn-delete" data-href="{{ url('news/feeds/'.$feed->id) }}">删除</a>
                        </td>
                    </tr>
                    @endforeach
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

            $('a.btn-delete').on('click', function () {
                var url = $(this).attr('data-href');
                swal({
                    title: '操作确认',
                    text: '确定要删除此新闻源吗?',
                    buttons: ['取消', '确定'],
                    dangerMode: true,
                }).then(function (confirmed) {
                    if (!confirmed) {
                        return false;
                    }
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function (response) {
                            location.reload();
                        },
                    });
                });
            });
        });
    </script>
@endpush
