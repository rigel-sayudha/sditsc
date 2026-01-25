<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="../images/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'SDIT SEMESTA CENDEKIA'))</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-gray-50">
   @include('partial.navbarberita')

    <main>
        @yield('content')
    </main>

    @include('partial.footer')

    @stack('scripts')
</body>
</html>