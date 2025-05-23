<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KKYO Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">

    {{-- Include your custom header --}}
    @include('components.header')

    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

</body>
</html>
