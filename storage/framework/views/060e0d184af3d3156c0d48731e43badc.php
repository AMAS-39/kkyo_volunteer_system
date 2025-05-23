<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Volunteer - KKYO Admin Panel</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-xl bg-gray-800 p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">➕ Add Volunteer</h2>

        <?php if($errors->any()): ?>
            <div class="bg-red-600 text-white p-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>⚠️ <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('volunteers.store')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            <div>
                <label for="name" class="block text-sm font-semibold mb-1">Name</label>
                <input type="text" name="name" id="name" required class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold mb-1">phone</label>
                <input type="number" name="phone" id="phone" required class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:ring-2 focus:ring-indigo-500">
            </div>

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role === 1): ?>
                    <div>
                        <label for="department_code" class="block text-sm font-semibold mb-1">Department</label>
                        <select name="department_code" id="department_code" required class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:ring-2 focus:ring-indigo-500">
                            <option value="" disabled selected>Select a Department</option>
                            <?php $__currentLoopData = App\Models\Department::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dept->code); ?>"><?php echo e($dept->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="text-center pt-2">
                <button type="submit" class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded font-semibold">
                    ✅ Submit Volunteer
                </button>
            </div>

            <div class="text-center pt-4">
                <a href="<?php echo e(route('volunteers.index')); ?>" class="text-sm text-indigo-300 hover:underline">🔙 Back to Volunteers</a>
            </div>
        </form>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views\volunteers\create.blade.php ENDPATH**/ ?>