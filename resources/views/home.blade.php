<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Home | opac</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="font-family: system-ui, sans-serif; padding: 2rem;">
  <h1>Selamat datang di halaman publik</h1>
  @if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
  @endif

  @auth
    <p>Anda sudah login sebagai <strong>{{ auth()->user()->name }}</strong>.</p>
    <p><a href="{{ route('dashboard') }}">Ke Dashboard</a> · <a href="{{ route('logout') }}">Logout</a></p>
  @else
    <a href="{{ route('login') }}" style="display:inline-block;padding:.6rem 1rem;border:1px solid #333;border-radius:.5rem;text-decoration:none;">Login dengan Keycloak</a>
  @endauth
</body>
</html>
