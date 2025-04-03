<?php
session_start();
include 'includes/db_connect.php';

// Check if all required POST fields are set
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format.';
        exit;
    }

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo 'Username or email already exists.';
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: pages/login.php');
            exit;
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
} else {
    echo 'Please fill in all fields.';
}
?>