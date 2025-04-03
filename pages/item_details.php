<?php
session_start();
include '../includes/db_connect.php';
include '../includes/header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM items WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $item = mysqli_fetch_assoc($result);
    if ($item) {
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-8">';
        echo '<div class="card">';
        echo '<img src="../assets/images/' . $item['image'] . '" class="card-img-top" alt="' . $item['name'] . '" style="max-height: 400px; object-fit: cover;">';
        echo '<div class="card-body">';
        echo '<h2 class="card-title">' . $item['name'] . '</h2>';
        echo '<p class="card-text">' . $item['description'] . '</p>';
        echo '<p class="card-text font-weight-bold">Price: $' . number_format($item['price'], 2) . '</p>';
        echo '<form action="../add_to_cart.php" method="post">';
        echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
        echo '<button type="submit" class="btn btn-success">Add to Cart</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        header('Location: index.php');
        exit;
    }
} else {
    echo '<p class="text-center">No item selected.</p>';
}
include '../includes/footer.php';
?>