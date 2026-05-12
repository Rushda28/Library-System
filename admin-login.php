<?php
session_start();

$admin_username = "Admin001";
$admin_password = "admin123"; 

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === $admin_username && $pass === $admin_password) {
        $_SESSION['user_id'] = 'ADMIN_MASTER';
        $_SESSION['role'] = 'admin';
        $_SESSION['full_name'] = 'System Librarian';
        header("Location: admin.php");
        exit();
    } else {
        $error = "Access Denied: Invalid Staff Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Entry | ESSSL</title>
    <link rel="stylesheet" href="assets/css/admin-login.css">
</head>
<body class="admin-auth">

    <div class="auth-container">
        <header>
            <span class="gate-label">Private Portal</span>
            <h1>Librarian <span>Entry</span></h1>
        </header>

        <form method="POST" action="">
            <?php if(isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required autocomplete="off">
            </div>

            <div class="input-group">
                <label>Access Key</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="login" class="login-btn">Authenticate →</button>
        </form>

        <footer>
            <a href="index.php">← Return to Public Library</a>
        </footer>
    </div>

</body>
</html>