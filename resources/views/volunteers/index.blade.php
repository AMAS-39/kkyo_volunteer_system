<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteers - KKYO Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        function liveSearchAndFilter() {
            const keyword = document.getElementById('live-search').value.toLowerCase();
            const filterDept = document.getElementById('department-filter')?.value;
            const rows = document.querySelectorAll('#volunteer-table tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('.name').innerText.toLowerCase();
                const code = row.querySelector('.code').innerText.toLowerCase();
                const dept = row.querySelector('.dept')?.innerText;

                const matchSearch = name.includes(keyword) || code.includes(keyword);
                const matchDept = !filterDept || dept === filterDept;

                row.style.display = (matchSearch && matchDept) ? '' : 'none';
            });
        }
    </script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    {{-- Header --}}
    @include('components.header')

    <main class="flex-grow p-6 max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">👥 Volunteers</h2>
            <a href="{{ route('volunteers.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                ➕ Add Volunteer
            </a>
        </div>

        {{-- ✅ Search + Filter --}}
        <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
            <input type="text" id="live-search" onkeyup="liveSearchAndFilter()" placeholder="Search by name or code"
                   class="w-full md:w-1/2 px-4 py-2 rounded bg-gray-800 text-white placeholder-gray-400 focus:outline-none">

            @if (Auth::user()->role == 1)
                <select id="department-filter" onchange="liveSearchAndFilter()"
                        class="w-full md:w-1/4 px-4 py-2 rounded bg-gray-800 text-white focus:outline-none">
                    <option value="">All Departments</option>
                    <option value="200">Technology</option>
                    <option value="300">Culture</option>
                    <option value="400">Education</option>
                    <option value="500">Media</option>
                    <option value="600">Economy</option>
                </select>
            @endif
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-4 bg-green-700 text-white px-4 py-2 rounded shadow-md">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Table --}}
        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-lg">
            <table class="min-w-full text-sm text-white" id="volunteer-table">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="p-3 border-b">ID</th>
                        <th class="p-3 border-b">Name</th>
                        <th class="p-3 border-b">Phone</th>
                        <th class="p-3 border-b">User Code</th>
                        @if (Auth::user()->role == 1)
                            <th class="p-3 border-b">Dept</th>
                        @endif
                        <th class="p-3 border-b">Points</th>
                        <th class="p-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($volunteers as $v)
                        <tr class="border-b border-gray-700 hover:bg-gray-800">
                            <td class="p-3">{{ $v->id }}</td>
                            <td class="p-3 name">{{ $v->name }}</td>
                            <td class="p-3">{{ $v->phone }}</td>
                            <td class="p-3 code">{{ $v->user_code }}</td>
                            @if (Auth::user()->role == 1)
                                <td class="p-3 dept">{{ $v->department_code }}</td>
                            @endif
                            <td class="p-3">{{ $v->points }}</td>
                            <td class="p-3 text-center space-x-2">
                                <a href="{{ route('volunteers.points', $v->id) }}" class="text-indigo-400 hover:underline">➕ Points</a>
                                <a href="{{ route('volunteers.history', $v->id) }}" class="text-yellow-400 hover:underline">📜 History</a>
                                <form action="{{ route('volunteers.destroy', $v) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this volunteer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-400">No volunteers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    {{-- Footer --}}
    @include('components.footer')
    
</body>
</html>
