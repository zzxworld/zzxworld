<!DOCTYPE html>
<html lang="en">
<head>
@include('components.meta')
<title>@yield('title', config('app.name', 'Laravel'))</title>
<link rel="stylesheet" href="{{ url('css/admin.css') }}" type="text/css" charset="utf-8">
@stack('css')
</head>
<body>
    <div id="app">@yield('content')</div>
@stack('js')
</body>
</html>
