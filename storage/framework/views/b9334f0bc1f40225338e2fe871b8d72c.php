<header class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">KKYO Admin Panel</h1>

        <nav class="space-x-4">
            <a href="<?php echo e(route('dashboard')); ?>"
               class="hover:text-yellow-300 <?php echo e(request()->routeIs('dashboard') ? 'font-bold text-yellow-300' : ''); ?>">
                🏠 Dashboard
            </a>

            <a href="<?php echo e(route('volunteers.index')); ?>"
               class="hover:text-yellow-300 <?php echo e(request()->routeIs('volunteers.*') && !request()->routeIs('volunteers.bulk.points.form') ? 'font-bold text-yellow-300' : ''); ?>">
                👥 Volunteers
            </a>

            <a href="<?php echo e(route('volunteers.bulk.points.form')); ?>"
               class="hover:text-yellow-300 <?php echo e(request()->routeIs('volunteers.bulk.points.form') ? 'font-bold text-yellow-300' : ''); ?>">
                ➕ Bulk Add Points
            </a>

            <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="hover:text-red-400">🚪 Logout</button>
            </form>
        </nav>
    </div>
</header>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views/components/header.blade.php ENDPATH**/ ?>