<?php
session_start();
include '../includes/db_connect.php';
include '../includes/header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<h2 class="text-center mb-4">Your Cart</h2>
<?php
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_items = array_count_values($_SESSION['cart']);
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped">';
    echo '<thead class="thead-dark"><tr><th>Item</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead>';
    echo '<tbody>';
    $total = 0;
    foreach ($cart_items as $item_id => $quantity) {
        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $item_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $item = mysqli_fetch_assoc($result);
        if ($item) {
            $subtotal = $item['price'] * $quantity;
            $total += $subtotal;
            echo '<tr>';
            echo '<td>' . $item['name'] . '</td>';
            echo '<td>' . $quantity . '</td>';
            echo '<td>$' . number_format($item['price'], 2) . '</td>';
            echo '<td>$' . number_format($subtotal, 2) . '</td>';
            echo '</tr>';
        }
    }
    echo '<tr class="font-weight-bold"><td colspan="3">Total</td><td>$' . number_format($total, 2) . '</td></tr>';
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<p class="text-center">Your cart is empty.</p>';
}
include '../includes/footer.php';
?>