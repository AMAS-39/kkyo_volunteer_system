<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bulk Add Points</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-xl bg-white border border-gray-200 shadow-xl rounded-2xl p-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">➕ Bulk Add Points</h2>
    <p class="text-gray-500 text-sm text-center mb-6">
      Select volunteers to give points to. As a <?php echo e(auth()->user()->role == 1 ? 'Chairwoman' : 'Department Head'); ?>, your access is limited.
    </p>

    <?php if(session('success')): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5 text-sm">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <form action="<?php echo e(route('volunteers.bulk.points.store')); ?>" method="POST" class="space-y-5">
      <?php echo csrf_field(); ?>

      <div>
        <label for="user_codes" class="block text-base font-semibold text-gray-700 mb-1">🧑‍🤝‍🧑 Select Volunteers</label>
        <select name="user_codes[]" id="user_codes" multiple required
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <?php $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($v->code); ?>"><?php echo e($v->name); ?> (<?php echo e($v->code); ?>) - Dept <?php echo e($v->department_code); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <p class="text-xs text-gray-400 mt-1">Hold Ctrl (Cmd on Mac) to select multiple.</p>
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
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
          ✅ Add Points
        </button>
      </div>
    </form>
  </div>

</body>
</html>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views/volunteers/bulk_points.blade.php ENDPATH**/ ?>