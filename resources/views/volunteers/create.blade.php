<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bulk Add Points</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen">

  {{-- 🔹 HEADER --}}
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-blue-800">KKYO Admin Panel</h1>
      <div class="text-sm text-gray-600">
        Logged in as: <span class="font-semibold">{{ auth()->user()->name }}</span>
      </div>
    </div>
  </header>

  {{-- 🔹 FORM CARD --}}
  <main class="flex justify-center py-12 px-4">
    <div class="w-full max-w-xl bg-white border border-gray-200 shadow-xl rounded-2xl p-10">
      <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">➕ Bulk Add Points</h2>
      <p class="text-gray-500 text-sm text-center mb-6">
        Select volunteers to give points to. As a {{ auth()->user()->role == 1 ? 'Chairwoman' : 'Department Head' }}, your access is limited.
      </p>

      @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 text-sm">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('volunteers.bulk.points.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label for="user_codes" class="block text-base font-semibold text-gray-700 mb-1">🧑‍🤝‍🧑 Select Volunteers</label>
          <select name="user_codes[]" id="user_codes" multiple required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @foreach($volunteers as $v)
              <option value="{{ $v->user_code }}">{{ $v->name }} ({{ $v->user_code }}) - Dept {{ $v->department_code }}</option>
            @endforeach
          </select>
          <p class="text-xs text-gray-400 mt-1">Hold Ctrl (Cmd on Mac) to select multiple.</p>
        </div>

        <div>
          <label for="points" class="block text-base font-semibold text-gray-700 mb-1">⭐ Points to Add</label>
          <input type="number" id="points" name="points" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            placeholder="e.g., 5">
        </div>

        <div>
          <label for="reason" class="block text-base font-semibold text-gray-700 mb-1">✍️ Reason</label>
          <input type="text" id="reason" name="reason" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            placeholder="e.g., Workshop Participation">
        </div>

        <div class="text-center pt-2">
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
            ✅ Add Points
          </button>
        </div>
      </form>
    </div>
  </main>

</body>
</html>
