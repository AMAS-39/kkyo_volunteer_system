<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KKYO Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    @include('components.header')

    <main class="flex-grow p-6">
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>
