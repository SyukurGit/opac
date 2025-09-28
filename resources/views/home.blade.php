<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center">
            <h1>Selamat Datang di Aplikasi OPAC</h1>
            <p>Silakan login untuk melanjutkan.</p>
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">Login dengan Keycloak</a>
            @endguest
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Masuk ke Dashboard</a>
            @endauth
        </div>
    </div>
</body>
</html>