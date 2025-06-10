<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Movie DB</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-link:hover {
            opacity: 0.85;
        }

        .btn {
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            transform: scale(1.03);
        }

        footer {
            background-color: #0d6efd;
            color: white;
        }

        .user-info {
            font-weight: 500;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-film"></i> Movie DB
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{-- Left Nav --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create_movie') }}">Input Movie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('layouts.datamovie') }}">Data Movie</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Category
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Drama</a></li>
                            <li><a class="dropdown-item" href="#">Comedy</a></li>
                        </ul>
                    </li>
                </ul>

                {{-- Right Nav --}}
                <div class="d-flex align-items-center gap-3">
                    {{-- Search --}}
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search movies..." aria-label="Search" />
                        <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
                    </form>

                    {{-- Auth --}}
                    @auth
                        <span class="text-white fw-bold">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="container my-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center py-3 mt-auto">
        <small>© 2025 - Manajemen Informatika 2A | Movie DB Project</small>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
