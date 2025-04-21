@extends('layouts.master')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">👑 Chairwoman Dashboard</h1>
        <p class="text-lg text-gray-300 mt-2">Welcome Awaz 👑</p>

        <a href="{{ route('volunteers.index') }}" class="inline-block mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
            👥 Manage Volunteers
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-white mb-8">
        <div class="bg-purple-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm text-purple-300">Total Volunteers</h3>
            <p class="mt-2 text-3xl font-bold">{{ \App\Models\Volunteer::count() }}</p>
        </div>

        <div class="bg-indigo-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm text-indigo-300">Total Points Awarded</h3>
            <p class="mt-2 text-3xl font-bold">{{ \App\Models\Volunteer::sum('points') }}</p>
        </div>

        <div class="bg-green-800 p-6 rounded-lg shadow-md">
            <h3 class="text-sm text-green-300">Departments</h3>
            <p class="mt-2 text-3xl font-bold">{{ \App\Models\Department::count() }}</p>
        </div>
    </div>

    <!-- Top Volunteers Table -->
    <div>
        <h3 class="text-xl font-semibold text-white mb-4">🏆 Top 5 Volunteers</h3>

        <div class="overflow-auto rounded-lg shadow border border-gray-700">
            <table class="w-full text-left text-white">
                <thead class="bg-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">phone</th>
                        <th class="px-4 py-3">Points</th>
                        <th class="px-4 py-3">User Code</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @foreach (\App\Models\Volunteer::orderByDesc('points')->take(5)->get() as $v)
                        <tr class="hover:bg-gray-700">
                            <td class="px-4 py-3">{{ $v->name }}</td>
                            <td class="px-4 py-3">{{ $v->phone }}</td>
                            <td class="px-4 py-3">{{ $v->points }}</td>
                            <td class="px-4 py-3">{{ $v->user_code }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
