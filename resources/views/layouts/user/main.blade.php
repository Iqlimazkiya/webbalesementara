<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bale Hinggil - @yield('title')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .text-dark-green { color: #2d5016; }
        .bg-dark-green { background-color: #2d5016; }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-white">

    @include('layouts.user.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.user.footer')

    @stack('scripts')
</body>
</html>