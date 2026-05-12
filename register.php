<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration | ESSSL Institute</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <h1>Join ESSSL <span>Library</span></h1>
            <p>Create an account to start borrowing books.</p>
            
            <form action="backend/register_logic.php" method="POST" id="regForm">
                <div class="input-row">
                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" placeholder="John Doe" required>
                    </div>
                    <div class="input-group">
                        <label>Student ID</label>
                        <input type="text" name="student_id" placeholder="ESSSL-2026-001" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="student@esssl.edu" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" id="pass" placeholder="Create a password" required>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_pass" placeholder="Repeat password" required>
                </div>

                <button type="submit" name="register_user" class="pill-button">Create Account</button>
            </form>

            <div class="footer-links">
                <p class="login-text">Already have an account? <a href="login.php">Login here</a></p>
                <a href="index.php" class="back-link">Back to Home</a>
            </div>
        </div>
    </div>
    
    <script src="assets/js/validation.js"></script>
</body>
</html>