<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['reserve_book'])) {

    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];

    // Insert reservation
    $sql = "INSERT INTO reservations (user_id, book_id)
            VALUES ('$user_id', '$book_id')";

    if(mysqli_query($conn, $sql)) {
        header("Location: ../reservation-success.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
