<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'SDIT SEMESTA CENDEKIA'))</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-gray-50">
   @include('partial.navbar')

    <main>
        @yield('content')
    </main>

    @include('partial.footer')

    @stack('scripts')
    
    <!-- SweetAlert untuk Logout Success -->
    @if(session('logout_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Logout Berhasil!',
            text: '{{ session('logout_success') }}',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end'
        });
    </script>
    @endif
</body>
</html>