<?php
session_start();
include '../includes/db_connect.php';
include '../includes/header.php';
?>
<div class="container-fluid p-0">
    <!-- Hero Section (Logged Out) or Main Content (Logged In) -->
    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="hero-section text-center text-white py-5" style="background: linear-gradient(135deg, #007bff, #0056b3);">
            <div class="container">
                <h1 class="display-3 mb-3">Welcome to E-Shop</h1>
                <p class="lead mb-4">Discover unbeatable deals on electronics, fashion, and more—all in one place!</p>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card login-card shadow-lg border-0" style="opacity: 0; position: relative; top: 20px;">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Welcome Back!</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Log in to access your account, track orders, and shop your favorites.</p>
                                <a href="login.php" class="btn btn-primary btn-login w-100">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card signup-card shadow-lg border-0" style="opacity: 0; position: relative; top: 20px;">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">New Here? Join Us!</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Sign up to unlock exclusive deals and start your shopping journey.</p>
                                <a href="signup.php" class="btn btn-success btn-signup w-100">Signup</a>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-4 small">By joining, you agree to our <a href="#" class="text-white">Terms of Service</a> and <a href="#" class="text-white">Privacy Policy</a>.</p>
            </div>
        </div>
    <?php else: ?>
        <div class="container py-5">
            <h2 class="text-center mb-4 display-4">Welcome to Your E-Shop</h2>
            <?php
            if (isset($_GET['added']) && $_GET['added'] == 'true') {
                echo '<div class="alert alert-success text-center" id="success-message">Item added successfully!</div>';
            }
            if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
                echo '<div class="alert alert-success text-center" id="success-message">Item deleted successfully!</div>';
            }
            ?>
            <!-- Search and Filter Panel -->
            <div class="card mb-5 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Find Your Items</h5>
                </div>
                <div class="card-body">
                    <form class="d-flex justify-content-center align-items-center flex-wrap gap-3" action="../pages/index.php" method="get">
                        <input class="form-control w-auto flex-grow-1" type="search" name="search" placeholder="Search Items" aria-label="Search" style="max-width: 400px;">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <!-- Items Grid -->
            <h3 class="mb-4 text-center">Available Items</h3>
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
                    echo '<div class="card h-100 shadow-sm border-0">';
                    echo '<div class="card-img-wrapper">';
                    echo '<img src="../assets/images/' . $item['image'] . '" class="card-img-top" alt="' . $item['name'] . '">';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title text-primary">' . $item['name'] . '</h5>';
                    echo '<p class="card-text text-muted small">' . substr($item['description'], 0, 100) . '...</p>';
                    echo '<p class="card-text price mb-3">$' . number_format($item['price'], 2) . '</p>';
                    echo '<div class="d-flex justify-content-between">';
                    echo '<a href="item_details.php?id=' . $item['id'] . '" class="btn btn-primary btn-sm">View Details</a>';
                    echo '<form action="../delete_item.php" method="post" class="d-inline">';
                    echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
                    echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include '../includes/footer.php'; ?>