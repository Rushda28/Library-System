<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if(isset($_GET['id'])) {

    $book_id = intval($_GET['id']);

    $sql = "DELETE FROM books WHERE id = $book_id";

    if(mysqli_query($conn, $sql)) {
        header("Location: ../admin.php");
        exit();
    } else {
        echo "Error deleting book.";
    }
}
?>
