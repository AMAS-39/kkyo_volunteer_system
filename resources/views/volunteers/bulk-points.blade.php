<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bulk Add Points</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Tom Select CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-900 to-blue-900 min-h-screen text-white">

  {{-- Include the shared header --}}
  @include('components.header')

  <div class="flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-xl bg-white text-gray-800 border border-gray-200 shadow-xl rounded-2xl p-10">
      <h2 class="text-3xl font-bold text-center mb-4">➕ Bulk Add Points</h2>
      <p class="text-gray-600 text-sm text-center mb-6">
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
            class="bg-blue-900 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
            ✅ Add Points
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Tom Select JS -->
  <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
  <script>
    new TomSelect('#user_codes', {
      plugins: ['remove_button'],
      maxItems: null,
      create: false,
      placeholder: 'Select volunteers...',
      persist: false,
    });
  </script>
</body>
</html>
