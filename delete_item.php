<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: pages/login.php');
    exit;
}

if (isset($_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];
    $sql = "DELETE FROM items WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $item_id);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: pages/index.php?deleted=true');
        exit;
    } else {
        echo 'Error deleting item: ' . mysqli_error($conn);
    }
} else {
    header('Location: pages/index.php');
    exit;
}
?>