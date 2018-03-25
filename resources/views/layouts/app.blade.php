<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', config('app.name', 'Laravel'))</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="canonical" href="{{ Request::url() }}">
</head>
<body>
    <div id="app-page">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('news') }}">头条</a></li>
                        <li><a href="{{ url('posts') }}">文章</a></li>
                        <li><a href="{{ url('linux/commands') }}">Linux 命令</a></li>
                        <li><a href="{{ url('task_boards') }}">任务板</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a rel="nofollow" href="{{ route('login') }}">登录</a></li>
                            <li><a rel="nofollow" href="{{ route('register') }}">注册</a></li>
                        @else

                            @can('create', App\Models\Post::class)
                            <li><a href="{{ route('posts.create') }}">新增文章</a></li>
                            @endcan

                            @can('view', App\Models\Post::class)
                            <li><a href="{{ route('comments.index') }}">评论管理</a></li>
                            @endcan

                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }}
                                    @if (Auth::user()->isRoot)
                                        <span class="label label-danger">MOD</span>
                                    @endif
                                    <span></span>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">退出</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if ($errors->any())
            <div class="container">
                <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')

    <!-- This page took {{ microtime(true) - LARAVEL_START }} seconds to display. -->
</body>
</html>
