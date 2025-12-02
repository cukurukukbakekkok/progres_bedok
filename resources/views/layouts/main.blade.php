<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 0 !important;
            padding: 0 !important;
            max-width: 100% !important;
        }
    </style>
</head>
<body style="margin: 0; padding: 0;">
    <nav style="background:#1a73e8; color:white; padding:10px; margin: 0;">
        <a href="/dashboard" style="color:white;">Dashboard</a> |
        <a href="/logout" style="color:white;">Logout</a>
    </nav>

    <div style="margin:0; padding:0;">
        @yield('content')
    </div>
</body>
</html>
