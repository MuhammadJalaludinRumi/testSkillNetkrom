<!DOCTYPE html>
<html>
<head>
    <title>Tiket Konser</title>
</head>
<body>
    <nav>
        <a href="{{ route('beranda') }}">Beranda</a> |
        @auth
        <a href="/logout">Logout</a>
        @else
        <a href="{{ route('admin.login.form') }}">Login</a>
        @endauth
    </nav>
    <hr>

    @yield('content')
</body>
</html>
