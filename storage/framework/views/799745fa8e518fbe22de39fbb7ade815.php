<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - KKYO Admin Panel</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-gray-800 p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">🔐 KKYO Login</h2>

        <?php if(session('error')): ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1" for="email">Email</label>
                <input class="w-full px-3 py-2 rounded bg-gray-700 text-white" type="email" name="email" required autofocus>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-1" for="password">Password</label>
                <input class="w-full px-3 py-2 rounded bg-gray-700 text-white" type="password" name="password" required>
            </div>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded font-semibold text-white">
                🔓 Log In
            </button>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views\auth\login.blade.php ENDPATH**/ ?>