<!DOCTYPE html>
<html lang="en">
<head>
@include('components.meta')
<title>@yield('title', config('app.name', 'Laravel'))</title>
@stack('head')
</head>
<body>
@yield('content')
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
@stack('bottom')
</body>
</html>
