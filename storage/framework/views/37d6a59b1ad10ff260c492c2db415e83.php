<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteers - KKYO Admin Panel</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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

    
    <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="flex-grow p-6 max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">👥 Volunteers</h2>
            <a href="<?php echo e(route('volunteers.create')); ?>"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                ➕ Add Volunteer
            </a>
        </div>

        
        <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
            <input type="text" id="live-search" onkeyup="liveSearchAndFilter()" placeholder="Search by name or code"
                   class="w-full md:w-1/2 px-4 py-2 rounded bg-gray-800 text-white placeholder-gray-400 focus:outline-none">

            <?php if(Auth::user()->role == 1): ?>
                <select id="department-filter" onchange="liveSearchAndFilter()"
                        class="w-full md:w-1/4 px-4 py-2 rounded bg-gray-800 text-white focus:outline-none">
                    <option value="">All Departments</option>
                    <option value="200">Technology</option>
                    <option value="300">Culture</option>
                    <option value="400">Education</option>
                    <option value="500">Media</option>
                    <option value="600">Economy</option>
                </select>
            <?php endif; ?>
        </div>

        
        <?php if(session('success')): ?>
            <div class="mb-4 bg-green-700 text-white px-4 py-2 rounded shadow-md">
                ✅ <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-lg">
            <table class="min-w-full text-sm text-white" id="volunteer-table">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="p-3 border-b">ID</th>
                        <th class="p-3 border-b">Name</th>
                        <th class="p-3 border-b">Phone</th>
                        <th class="p-3 border-b">User Code</th>
                        <?php if(Auth::user()->role == 1): ?>
                            <th class="p-3 border-b">Dept</th>
                        <?php endif; ?>
                        <th class="p-3 border-b">Points</th>
                        <th class="p-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-700 hover:bg-gray-800">
                            <td class="p-3"><?php echo e($v->id); ?></td>
                            <td class="p-3 name"><?php echo e($v->name); ?></td>
                            <td class="p-3"><?php echo e($v->phone); ?></td>
                            <td class="p-3 code"><?php echo e($v->user_code); ?></td>
                            <?php if(Auth::user()->role == 1): ?>
                                <td class="p-3 dept"><?php echo e($v->department_code); ?></td>
                            <?php endif; ?>
                            <td class="p-3"><?php echo e($v->points); ?></td>
                            <td class="p-3 text-center space-x-2">
                                <a href="<?php echo e(route('volunteers.points', $v->id)); ?>" class="text-indigo-400 hover:underline">➕ Points</a>
                                <a href="<?php echo e(route('volunteers.history', $v->id)); ?>" class="text-yellow-400 hover:underline">📜 History</a>
                                <form action="<?php echo e(route('volunteers.destroy', $v)); ?>" method="POST" class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this volunteer?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:underline">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-400">No volunteers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    
    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
</body>
</html>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views/volunteers/index.blade.php ENDPATH**/ ?>