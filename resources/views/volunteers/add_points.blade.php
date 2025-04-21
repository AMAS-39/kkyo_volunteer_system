<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Points - KKYO Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    {{-- ✅ Header Component --}}
    <x-header />

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="w-full max-w-xl bg-gray-800 p-8 rounded-lg shadow-xl space-y-6">
            <h2 class="text-2xl font-bold text-center">
                🎯 Add Points to <span class="text-indigo-400">{{ $volunteer->name }}</span>
            </h2>

            @if ($errors->any())
                <div class="bg-red-600 text-white p-3 rounded">
                    <ul class="text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('volunteers.points.store', $volunteer->id) }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold mb-1">Points <span class="text-gray-400">(use + or -)</span></label>
                    <input type="number" name="points" class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Reason</label>
                    <textarea name="reason" rows="3" class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded font-semibold">
                        ✅ Submit Points
                    </button>
                </div>
            </form>

            <div class="text-center pt-2">
                <a href="{{ route('volunteers.index') }}" class="text-sm text-indigo-300 hover:underline">🔙 Back to Volunteers</a>
            </div>
        </div>
    </main>

    {{-- ✅ Footer Component --}}
    <x-footer />
</body>
</html>
