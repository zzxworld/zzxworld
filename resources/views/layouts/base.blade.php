<!DOCTYPE html>
<html lang="en">
<head>
@include('components.meta')
<title>@yield('title', config('app.name', 'Laravel'))</title>
@stack('head')
</head>
<body>
@yield('content')
<script src="{{ url('assets/js/runtime.js') }}"></script>
<script src="{{ url('assets/js/vendor.js') }}"></script>
@stack('bottom')
</body>
</html>
