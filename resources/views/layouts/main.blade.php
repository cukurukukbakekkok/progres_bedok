<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <nav style="background:#1a73e8; color:white; padding:10px;">
        <a href="/dashboard" style="color:white;">Dashboard</a> |
        <a href="/logout" style="color:white;">Logout</a>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
