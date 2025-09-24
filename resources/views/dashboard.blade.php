<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Dashboard | opac</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="font-family: system-ui, sans-serif; padding: 2rem;">
  <h1>Anda sudah login</h1>
  <p>Halo, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})</p>
  <p><a href="{{ route('logout') }}">Logout dari SSO</a> · <a href="{{ route('home') }}">Kembali ke Home</a></p>
</body>
</html>
