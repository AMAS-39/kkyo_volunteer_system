<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point History - {{ $volunteer->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen p-6">

{{-- 💡 Include global header --}}
@include('components.header')
    <div class="max-w-5xl mx-auto bg-gray-800 rounded-lg shadow-lg p-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">📜 Point History - {{ $volunteer->name }}</h2>
            <a href="{{ route('volunteers.index') }}" class="text-sm text-indigo-400 hover:underline">
                ← Back to Volunteers
            </a>
        </div>

        @if($history->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="p-3 border-b border-gray-600">📅 Date</th>
                            <th class="p-3 border-b border-gray-600">⭐ Points</th>
                            <th class="p-3 border-b border-gray-600">✍️ Reason</th>
                            <th class="p-3 border-b border-gray-600">👤 Added By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $log)
                            <tr class="hover:bg-gray-700 border-b border-gray-700">
                                <td class="p-3">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                <td class="p-3">{{ $log->points }}</td>
                                <td class="p-3">{{ $log->reason }}</td>
                                <td class="p-3">{{ $log->addedBy->name ?? 'Unknown' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-gray-300 mt-6">
                ⚠️ No point history found for this volunteer.
            </div>
        @endif
    </div>

</body>
</html>
