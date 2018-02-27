@extends('layouts/app')

@section('title', $post->title.' | zzxworld')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">{{ $post->title }}</h1>
                <span>{{ $post->published_at->format('Y-m-d') }}</span>

                @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}">编辑</a>
                @endcan

                @can('delete', $post)
                <a href="javascript:;" class="btn-delete" data-id="{{ $post->id }}">删除</a>
                @endcan
            </div>
            <div class="panel-body">
                {!! $post->html !!}
            </div>
            @if ($post->source_url)
            <div class="panel-footer">
                本文来源: <a href="{{ $post->source_url }}" rel="external nofollow" target="_blank">{{ $post->source_url_domain }}</a>
            </div>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script charset="utf-8">
        $(function () {
            $('.btn-delete').on('click', function (e) {
                if (!confirm('确定要删除此文章吗?')) {
                    return false;
                }

                $.ajax({
                    url: '/posts/'+e.target.dataset.id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        location.href = '/posts';
                    }
                });
            });
        });
    </script>
@endpush
