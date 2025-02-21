<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Rental Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Rental Kendaraan</h1>
                <nav>
                    <a href="{{ route('home') }}" class="text-white mx-3">Beranda</a>
                    <a href="{{ route('kendaraan.index') }}" class="text-white mx-3">Daftar Kendaraan</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            &copy; {{ date('Y') }} Rental Kendaraan. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
