<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volunteers - KKYO Admin Panel</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    
    <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <main class="flex-grow p-6 max-w-7xl mx-auto">
        <!-- Header & Add Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">👥 Volunteers</h2>
            <a href="<?php echo e(route('volunteers.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                ➕ Add Volunteer
            </a>
        </div>

        <!-- Success Flash -->
        <?php if(session('success')): ?>
            <div class="mb-4 bg-green-700 text-white px-4 py-2 rounded shadow-md">
                ✅ <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

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
                    <?php $__empty_1 = true; $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-700 hover:bg-gray-800">
                            <td class="p-3"><?php echo e($v->id); ?></td>
                            <td class="p-3"><?php echo e($v->name); ?></td>
                            <td class="p-3"><?php echo e($v->phone); ?></td>
                            <td class="p-3"><?php echo e($v->user_code); ?></td>
                            <td class="p-3"><?php echo e($v->points); ?></td>
                            <td class="p-3 text-center space-x-2">
                                <a href="<?php echo e(route('volunteers.points', $v->id)); ?>"
                                   class="text-indigo-400 hover:underline">➕ Points</a>

                                <a href="<?php echo e(route('volunteers.history', $v->id)); ?>"
                                   class="text-yellow-400 hover:underline">📜 History</a>

                                <form action="<?php echo e(route('volunteers.destroy', $v)); ?>" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this volunteer?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:underline">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-400">No volunteers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    
    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views\volunteers\index.blade.php ENDPATH**/ ?>