<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    exit("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['res_id'])) {
    $res_id = mysqli_real_escape_string($conn, $_POST['res_id']);
    $action = $_POST['action'];

    if ($action === 'issue') {
        $newStatus = 'issued';
    } elseif ($action === 'return') {
        $newStatus = 'returned';
    }

    $query = "UPDATE reservations SET status = '$newStatus' WHERE id = '$res_id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin.php?msg=success");
    } else {
        header("Location: ../admin.php?msg=error");
    }
}
?>