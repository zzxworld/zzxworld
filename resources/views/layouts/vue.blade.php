<!DOCTYPE html>
<html lang="zh-cn">
<head>
@include('components.meta')
<title>@yield('title', config('app.name', 'zzxworld'))</title>
@stack('head')
</head>
<body>
    <div id="app">@yield('content')</div>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    @stack('body')
</body>
</html>
