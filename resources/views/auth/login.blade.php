<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KKYO Login</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen text-white">
  <div class="w-full max-w-md p-10 bg-gray-800 rounded-xl shadow-xl space-y-6">
    <div class="text-center">
      <h2 class="text-3xl font-bold mb-1">🔐  Admin Login</h2>
      <p class="text-gray-400 text-sm">Welcome back! Please enter your credentials.</p>
    </div>

    @if(session('error'))
      <div class="bg-red-500 text-white text-sm p-3 rounded">
        {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium mb-1">Email</label>
        <input
          type="email"
          name="email"
          required
          autofocus
          class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium mb-1">Password</label>
        <input
          type="password"
          name="password"
          required
          autocomplete="current-password"
          class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

      <button
        type="submit"
        class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 rounded text-white font-semibold transition duration-200"
      >
        🔐 Log In
      </button>
    </form>

    <div class="text-center text-sm text-gray-500 mt-4">
      Forgot your password?
      <a href="#" class="text-indigo-400 hover:underline">Reset it</a>
    </div>
  </div>
</body>
</html>
