<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | ESSSL Library System</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

    <div class="login-wrapper">
        <div class="login-box">
            
            <?php if(isset($_GET['auth']) && $_GET['auth'] == 'required'): ?>
                <div class="php-alert-box">
                    <span class="alert-label">Access Restricted</span>
                    <p>Please log in to your account to view the library collection.</p>
                </div>
            <?php endif; ?>

            <h1>ESSSL <span>Login</span></h1>
            <p>Access the Student Library System</p>
            
            <form action="backend/login_logic.php" method="POST">
                <div class="input-group">
                    <label>User ID</label>
                    <input type="text" name="user_id" placeholder="e.g. STU101" required>
                </div>
                
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                
                <button type="submit" name="submit_login" class="pill-button">Login</button>
            </form>
            
            <div class="footer-links">
                <p class="reg-text">Don't have an account? <a href="register.php">Register</a></p>
                <a href="index.php" class="back-link">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>