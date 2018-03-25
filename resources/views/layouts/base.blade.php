<!DOCTYPE html>
<html lang="en">
<head>
@include('components.meta')
<title>@yield('title', config('app.name', 'Laravel'))</title>
@stack('head')
</head>
<body>
@yield('content')
@stack('bottom')
</body>
</html>
