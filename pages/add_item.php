<?php
session_start();
include '../includes/db_connect.php';
include '../includes/header.php';

// Restrict access to logged-in users
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<h2>Add New Item</h2>
<form action="../add_item_process.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Item Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Item</button>
</form>

<?php include '../includes/footer.php'; ?>