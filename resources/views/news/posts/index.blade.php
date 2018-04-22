@extends('layouts/app')

@section('title', '头条 | zzxworld')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">头条</h4>
            </div>
            <ul class="list-group">
                @foreach ($posts as $post)
                    <li class="list-group-item news-item">
                        @can('update', $post)
                            <a class="btn-disable btn btn-default btn-xs pull-right" href="javascript:;" data-id="{{ $post->id }}">禁止</a>
                        @endcan

                        <header>
                            @if ($post->created_at->isToday())
                                <span class="label label-text date date-today">{{ $post->created_at->format('Y-m-d') }}</span>
                            @else
                                <span class="label label-text date">{{ $post->created_at->format('Y-m-d') }}</span>
                            @endif

                            @if ($post->feed)
                            <span class="label label-text">{{ $post->feed->name }}</span>
                            @endif
                        </header>

                        <a class="title" href="{{ url('news/'.$post->id) }}">{{ $post->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        {{ $posts->links() }}
    </div>

@endsection

@push('js')
    <script charset="utf-8">
        $(function () {
            $('.btn-disable').on('click', function () {
                var element = $(this);
                axios.put('news/'+element.attr('data-id'), {
                    is_disabled: true,
                }).then(function (response) {
                    element.parent().remove();
                }).catch(function () {
                    return false;
                });
            });
        });
    </script>
@endpush
