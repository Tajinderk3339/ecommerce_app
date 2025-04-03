<?php
session_start();
include '../includes/header.php';
?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card mt-5">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login</h2>
                <form action="../login_process.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>