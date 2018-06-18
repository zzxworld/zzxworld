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
@stack('css')
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
                        <li><a href="{{ url('sites') }}">网站</a></li>
                        <li><a href="{{ url('posts') }}">文章</a></li>
                        <li><a href="{{ url('linux/commands') }}">Linux 命令</a></li>
                        <li><a href="{{ url('task_boards') }}">任务板</a></li>
                        <li><a href="{{ url('notebooks') }}">笔记本</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a rel="nofollow" href="{{ route('login') }}">登录</a></li>
                            <li><a rel="nofollow" href="{{ route('register') }}">注册</a></li>
                        @else

                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }}
                                    @if (Auth::user()->isRoot)
                                        <span class="label label-danger">MOD</span>
                                    @endif
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @if (Auth::user()->isRoot)
                                    <li><a href="{{ url('admin/sites') }}">网站管理</a></li>
                                    <li><a href="{{ route('users.index') }}">用户管理</a></li>
                                    <li><a href="{{ route('comments.index') }}">评论管理</a></li>
                                    <li><a href="{{ route('posts.create') }}">新增文章</a></li>
                                    <li><a href="{{ route('feeds.index') }}">头条数据源</a></li>
                                    <li role="separator" class="divider"></li>
                                    @endif
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

    <script src="{{ url('assets/js/vendor.js') }}"></script>
    <script src="{{ asset_url('app.js') }}"></script>
    @stack('js')

    @if (defined('LARAVEL_START'))
    <!-- This page took {{ microtime(true) - LARAVEL_START }} seconds to display. -->
    @endif
</body>
</html>
