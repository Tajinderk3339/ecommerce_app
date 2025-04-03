<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce App</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <!-- Hamburger Menu Toggle -->
            <button class="navbar-toggler sidebar-toggle" type="button" aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../pages/index.php">E-Shop</a>
            <!-- User Profile with Dropdown -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/profile.jpg" alt="Profile" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                        
                        <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li class="dropdown-item-text">
                            <strong>Username:</strong> <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'N/A'; ?>
                        </li>
                        <li class="dropdown-item-text">
                            <strong>Email:</strong> <?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'N/A'; ?>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white p-3">
        <h4 class="sidebar-title">Menu</h4>
        <ul class="nav flex-column">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/add_item.php">Add Item</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/signup.php">Signup</a>
                </li>
            <?php endif; ?>
        </ul>
        <!-- Theme Picker -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <h5 class="mt-4">Theme Color</h5>
            <div class="theme-picker">
                <button class="theme-btn" data-color="blue" style="background-color: #007bff;"></button>
                <button class="theme-btn" data-color="red" style="background-color: #ff6f61;"></button>
                <button class="theme-btn" data-color="green" style="background-color: #28a745;"></button>
            </div>
        <?php endif; ?>
    </div>

    <div class="container mt-4">