<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Data Siswa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Nama Website -->
            <a class="navbar-brand fw-bold" href="#">Data Siswa</a>

            <!-- Toggle Navbar (Mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Navbar -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Dropdown Profil -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Menampilkan foto profil -->
                            <img src="{{ asset('uploads/' . (Auth::user()->profile_picture ?? 'default.jpg')) }}" class="rounded-circle" width="40" height="40" alt="Profile Picture" id="profilePic">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="#" onclick="document.getElementById('profileInput').click(); return false;">Ubah Foto</a>
                            </li>
                            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input type="file" id="profileInput" name="profile" onchange="document.getElementById('profileForm').submit();">
                            </form>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Informasi Admin</a></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>                                                    
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
