<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteers - KKYO Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    {{-- 💡 Include global header --}}
    @include('components.header')

    {{-- 💡 Page Content --}}
    <main class="flex-grow p-6 max-w-7xl mx-auto">
        <!-- Header & Add Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">👥 Volunteers</h2>
            <a href="{{ route('volunteers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                ➕ Add Volunteer
            </a>
        </div>

        <!-- Success Flash -->
        @if (session('success'))
            <div class="mb-4 bg-green-700 text-white px-4 py-2 rounded shadow-md">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Volunteer Table -->
        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-lg">
            <table class="min-w-full text-sm text-white">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="p-3 border-b">ID</th>
                        <th class="p-3 border-b">Name</th>
                        <th class="p-3 border-b">phone</th>
                        <th class="p-3 border-b">User Code</th>
                        <th class="p-3 border-b">Points</th>
                        <th class="p-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($volunteers as $v)
                        <tr class="border-b border-gray-700 hover:bg-gray-800">
                            <td class="p-3">{{ $v->id }}</td>
                            <td class="p-3">{{ $v->name }}</td>
                            <td class="p-3">{{ $v->phone }}</td>
                            <td class="p-3">{{ $v->user_code }}</td>
                            <td class="p-3">{{ $v->points }}</td>
                            <td class="p-3 text-center space-x-2">
                                <a href="{{ route('volunteers.points', $v->id) }}"
                                   class="text-indigo-400 hover:underline">➕ Points</a>

                                <a href="{{ route('volunteers.history', $v->id) }}"
                                   class="text-yellow-400 hover:underline">📜 History</a>

                                <form action="{{ route('volunteers.destroy', $v) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this volunteer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-400">No volunteers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    {{-- 💡 Include global footer --}}
    @include('components.footer')

</body>
</html>
