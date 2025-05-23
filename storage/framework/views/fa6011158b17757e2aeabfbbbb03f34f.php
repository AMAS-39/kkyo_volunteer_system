<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KKYO Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">

    
    <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="max-w-7xl mx-auto px-4 py-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views\layouts\master.blade.php ENDPATH**/ ?>