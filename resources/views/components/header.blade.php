<header class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">KKYO Admin Panel</h1>

        <nav class="space-x-4">
            <a href="{{ route('dashboard') }}"
               class="hover:text-yellow-300 {{ request()->routeIs('dashboard') ? 'font-bold text-yellow-300' : '' }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('volunteers.index') }}"
               class="hover:text-yellow-300 {{ request()->routeIs('volunteers.*') && !request()->routeIs('volunteers.bulk.points.form') ? 'font-bold text-yellow-300' : '' }}">
                👥 Volunteers
            </a>

            <a href="{{ route('volunteers.bulk.points.form') }}"
               class="hover:text-yellow-300 {{ request()->routeIs('volunteers.bulk.points.form') ? 'font-bold text-yellow-300' : '' }}">
                ➕ Bulk Add Points
            </a>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:text-red-400">🚪 Logout</button>
            </form>
        </nav>
    </div>
</header>
