<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKYO Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gray-800 text-white px-6 py-4 shadow flex justify-between items-center">
        <div class="text-xl font-bold">KKYO Admin Panel</div>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            <a href="{{ route('volunteers.index') }}" class="hover:underline">Volunteers</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="p-6 max-w-7xl mx-auto">
        @yield('content')
    </main>

</body>
</html>
