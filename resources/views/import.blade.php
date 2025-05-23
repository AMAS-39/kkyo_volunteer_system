<form action="/import-volunteers" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Import Volunteers</button>
</form>
