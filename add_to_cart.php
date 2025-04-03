<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $_SESSION['cart'][] = $item_id;
    header('Location: pages/cart.php');
    exit;
} else {
    header('Location: pages/login.php');
    exit;
}
?>