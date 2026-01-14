<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PPDB') }} - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <style>
        :root {
            --primary-color: #006aff;
        }

        body { 
            background-color: #f6f9fc; 
            font-family: 'Public Sans', sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 6px 18px rgba(102, 126, 234, 0.12);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 18px;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 8px;
        }

        .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 6px 12px;
        }

        .navbar-user {
            color: rgba(255, 255, 255, 0.95);
            font-weight: 600;
            margin-right: 15px;
        }

        .btn-logout {
            background: transparent !important;
            color: white !important;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            transform: translateY(-2px);
        }

        .card-custom { 
            border-radius: 15px; 
            box-shadow: 0 4px 10px rgba(0,0,0,.06);
            border: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/my/logo-antrek.png') }}" alt="logo">
            <span>PPDB Online</span>
        </a>
        <div class="d-flex align-items-center ms-auto">
            <span class="navbar-user">Halo, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-logout btn-sm fw-600">
                    <i class="ti ti-logout"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
