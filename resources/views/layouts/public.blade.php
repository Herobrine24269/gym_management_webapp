<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FitCore Gym Management')</title>
    <link rel="stylesheet" href="{{ asset('css/fitcore.css') }}">
    @yield('styles')
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh; background-color: var(--bg-dark-2); color: var(--text-primary);">
    <!-- Shared Public Navbar -->
    @include('partials.navbar')

    <!-- Page Main Content Slot -->
    <main style="flex: 1;">
        @yield('content')
    </main>

    <!-- Shared Public Footer -->
    @include('partials.footer')

    @yield('modals')
    @yield('scripts')
</body>
</html>
