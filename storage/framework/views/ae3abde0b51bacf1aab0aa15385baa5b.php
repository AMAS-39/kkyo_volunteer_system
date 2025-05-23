<form action="/import-volunteers" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="file" name="file" required>
    <button type="submit">Import Volunteers</button>
</form>
<?php /**PATH C:\laragon\www\kkyo-volunteer-system\resources\views\import.blade.php ENDPATH**/ ?>