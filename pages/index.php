<?php
session_start();
include '../includes/db_connect.php';
include '../includes/header.php';
?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Welcome to Our E-commerce App</h2>
    <?php
    if (isset($_GET['added']) && $_GET['added'] == 'true') {
        echo '<div class="alert alert-success text-center" id="success-message">Item added successfully!</div>';
    }
    if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
        echo '<div class="alert alert-success text-center" id="success-message">Item deleted successfully!</div>';
    }
    if (isset($_SESSION['user_id'])): ?>
        <form class="d-flex mb-4 justify-content-center" action="../pages/index.php" method="get">
            <input class="form-control me-2" type="search" name="search" placeholder="Search Items" aria-label="Search" style="max-width: 300px;">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
        <h3 class="mb-3">Available Items</h3>
        <div class="row" id="item-list">
            <?php
            $sql = "SELECT * FROM items";
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = '%' . $_GET['search'] . '%';
                $sql .= " WHERE name LIKE ? OR description LIKE ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ss', $search, $search);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            } else {
                $result = mysqli_query($conn, $sql);
            }
            while ($item = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4 col-sm-6 mb-4 item-card" style="display: none;">';
                echo '<div class="card h-100">';
                echo '<img src="../assets/images/' . $item['image'] . '" class="card-img-top" alt="' . $item['name'] . '" style="height: 200px; object-fit: cover;">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $item['name'] . '</h5>';
                echo '<p class="card-text text-muted">' . substr($item['description'], 0, 100) . '...</p>';
                echo '<p class="card-text font-weight-bold">$' . number_format($item['price'], 2) . '</p>';
                echo '<a href="item_details.php?id=' . $item['id'] . '" class="btn btn-primary btn-sm">View Details</a>';
                echo '<form action="../delete_item.php" method="post" class="d-inline">';
                echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
                echo '<button type="submit" class="btn btn-danger btn-sm ml-2" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    <?php else: ?>
        <div class="text-center mb-5">
            <h2 class="display-4">Welcome to E-Shop</h2>
            <p class="lead">Discover amazing deals on electronics, fashion, and more—all in one place!</p>
            <p>Get started by logging in or signing up to unlock exclusive offers and a personalized shopping experience.</p>
        </div>
        <div class="row justify-content-center">
            <!-- Login Card -->
            <div class="col-md-5 mb-4">
                <div class="card login-card" style="opacity: 0; position: relative; top: 20px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Welcome Back!</h5>
                        <p class="card-text">Log in to access your account, track orders, and shop your favorite items.</p>
                        <a href="login.php" class="btn btn-primary btn-login">Login</a>
                    </div>
                </div>
            </div>
            <!-- Signup Card -->
            <div class="col-md-5 mb-4">
                <div class="card signup-card" style="opacity: 0; position: relative; top: 20px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">New Here? Join Us!</h5>
                        <p class="card-text">Sign up today to explore exclusive deals and start your shopping journey.</p>
                        <a href="signup.php" class="btn btn-primary btn-signup">Signup</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>By joining, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
        </div>
    <?php endif; ?>
</div>
<?php include '../includes/footer.php'; ?>