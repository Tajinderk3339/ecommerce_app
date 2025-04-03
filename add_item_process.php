<?php
session_start();
include 'includes/db_connect.php';

// Restrict access to logged-in users
if (!isset($_SESSION['user_id'])) {
    header('Location: pages/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = floatval($_POST['price']); // Convert to float

    // Validate inputs
    if (empty($name) || empty($description) || $price <= 0 || !isset($_FILES['image'])) {
        echo 'All fields are required, and price must be positive.';
        exit;
    }

    // Handle file upload
    $image = $_FILES['image'];
    $image_name = basename($image['name']);
    $image_path = 'assets/images/' . $image_name;
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($image['type'], $allowed_types)) {
        echo 'Only JPEG, PNG, or GIF images are allowed.';
        exit;
    }

    if ($image['size'] > 5000000) { // 5MB limit
        echo 'Image size must be less than 5MB.';
        exit;
    }

    // Move uploaded file to assets/images/
    if (move_uploaded_file($image['tmp_name'], $image_path)) {
        // Insert item into database
        $sql = "INSERT INTO items (name, description, price, image) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssds', $name, $description, $price, $image_name);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: pages/index.php');
            exit;
        } else {
            echo 'Error adding item: ' . mysqli_error($conn);
        }
    } else {
        echo 'Error uploading image.';
    }
} else {
    echo 'Invalid request method.';
}
?>