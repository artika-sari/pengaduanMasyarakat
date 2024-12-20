<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} </title>
    <!-- Link ke CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fontawesome.com/icons/trash?f=classic&s=solids">
    <link rel="stylesheet" href="{{ asset('assets/css/nav.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-md-top" style="border-radius: 60px;" >
        <div class="container-fluid">
            <a class="navbar-brand">Pengaduan Masyarakat</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    {{-- @if (Auth::check()) --}}
                        
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 {{ Route::is('reports') ? 'active' : '' }}" aria-current="page" href="{{ route('reports') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 {{ Route::is('reports.artikel') ? 'active' : '' }}" href="{{ route('reports.artikel') }}">Artikel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 {{ Route::is('reports.create') ? 'active' : '' }}" href="{{ route('reports.create') }}">Buat Artikel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 {{ Route::is('dashboard') }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    </ul>
                    {{-- @endif --}}
                </div>
            </div>
            <a href="{{ route('logout') }}" class="logout-button">Logout</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>


    @yield('content-dinamis')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    @stack('script')
</body>

</html>
