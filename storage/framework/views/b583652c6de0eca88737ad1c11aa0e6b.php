<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KKYO Admin</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="flex-grow p-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views\layouts\base.blade.php ENDPATH**/ ?>