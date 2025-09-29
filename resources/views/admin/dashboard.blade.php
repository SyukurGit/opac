<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - OPAC</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #2c3e50;
            --sidebar-link-color: #ecf0f1;
            --sidebar-link-hover: #34495e;
            --sidebar-link-active: #2980b9;
            --content-bg: #f4f6f9;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--content-bg);
        }

        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: white;
            transition: all 0.3s;
        }

        .sidebar .sidebar-header {
            padding: 20px;
            background: #233140;
            text-align: center;
        }
        
        .sidebar .sidebar-header h3 {
            margin-bottom: 0;
            font-weight: 600;
        }

        .sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        .sidebar ul p {
            color: white;
            padding: 10px;
        }

        .sidebar ul li a {
            padding: 15px 20px;
            font-size: 1.1em;
            display: block;
            color: var(--sidebar-link-color);
            transition: all 0.2s;
        }

        .sidebar ul li a:hover {
            color: #fff;
            background: var(--sidebar-link-hover);
            text-decoration: none;
        }

        .sidebar ul li.active > a,
        a[aria-expanded="true"] {
            color: #fff;
            background: var(--sidebar-link-active);
        }
        
        .sidebar ul li a i {
            margin-right: 10px;
        }

        .content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>OPAC Admins</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                </ul>
        </nav>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded shadow-sm mb-4">
                <div class="container-fluid">
                    <div class="ms-auto">
                         <ul class="navbar-nav">
                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="user-avatar me-2">
                                    @else
                                        <i class="fas fa-user-circle fa-2x me-2"></i>
                                    @endif
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a></li>
                                </ul>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>