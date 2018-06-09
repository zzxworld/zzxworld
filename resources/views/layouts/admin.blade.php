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
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    @stack('js')
</body>
</html>
