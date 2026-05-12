<?php
// 1. Start the session to find the user
session_start();

// 2. Unset all session variables (User ID, Role, etc.)
$_SESSION = array();

// 3. Destroy the session entirely
session_destroy();

// 4. Redirect the user back to the login page immediately
header("Location: index.php");
exit;
?>