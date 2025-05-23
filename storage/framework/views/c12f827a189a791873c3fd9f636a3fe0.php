<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bulk Add Points</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-100 to-gray-200 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-xl bg-white shadow-xl rounded-xl p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">➕ Bulk Add Points</h2>
        <p class="text-gray-600 text-center mb-6">Add points to multiple volunteers by entering their user codes.</p>

        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('volunteers.bulk.points.store')); ?>" method="POST" class="space-y-5">
            <?php echo csrf_field(); ?>

            <div>
                <label for="user_codes" class="block text-sm font-semibold text-gray-700 mb-1">🆔 User Codes (comma-separated)</label>
                <input type="text" id="user_codes" name="user_codes" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="e.g., 201,202,203">
            </div>

            <div>
                <label for="points" class="block text-sm font-semibold text-gray-700 mb-1">⭐ Points to Add</label>
                <input type="number" id="points" name="points" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="e.g., 5">
            </div>

            <div>
                <label for="reason" class="block text-sm font-semibold text-gray-700 mb-1">✍️ Reason</label>
                <input type="text" id="reason" name="reason" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="e.g., Workshop Participation">
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200 shadow-md">
                    ✅ Add Points
                </button>
            </div>
        </form>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views\volunteers\bulk_points.blade.php ENDPATH**/ ?>