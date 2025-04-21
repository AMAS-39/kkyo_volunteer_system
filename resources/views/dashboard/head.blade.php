@extends('layouts.master')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-yellow-300">Welcome {{ Auth::user()->name }} 🎓</h1>
        <p class="text-gray-400 mt-1">Head of {{ \App\Models\Department::where('code', Auth::user()->department_code)->value('name') }}</p>
    </div>

    <!-- Quick Actions -->
    <div class="mb-6">
        <a href="{{ route('volunteers.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded shadow">
            👥 Manage My Volunteers
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-gradient-to-r from-purple-800 to-indigo-900 p-6 rounded-lg shadow-md">
            <h3 class="text-sm text-purple-300">Volunteers in Department</h3>
            <p class="text-4xl font-bold mt-2">
                {{ \App\Models\Volunteer::where('department_code', Auth::user()->department_code)->count() }}
            </p>
        </div>
        <div class="bg-gradient-to-r from-indigo-800 to-purple-900 p-6 rounded-lg shadow-md">
            <h3 class="text-sm text-indigo-300">Total Points</h3>
            <p class="text-4xl font-bold mt-2">
                {{ \App\Models\Volunteer::where('department_code', Auth::user()->department_code)->sum('points') }}
            </p>
        </div>
    </div>

    <!-- Volunteer Table -->
    <div>
        <h2 class="text-xl font-semibold text-white mb-4">📋 Volunteers</h2>
        <div class="overflow-x-auto">
            <table class="w-full bg-gray-800 rounded shadow-md text-left">
                <thead class="bg-gray-700 text-yellow-300">
                    <tr>
                        <th class="p-3">Name</th>
                        <th class="p-3">phone</th>
                        <th class="p-3">User Code</th>
                        <th class="p-3">Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\Volunteer::where('department_code', Auth::user()->department_code)->get() as $v)
                        <tr class="border-t border-gray-700 hover:bg-gray-750">
                            <td class="p-3">{{ $v->name }}</td>
                            <td class="p-3">{{ $v->phone }}</td>
                            <td class="p-3">{{ $v->user_code }}</td>
                            <td class="p-3">{{ $v->points }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
