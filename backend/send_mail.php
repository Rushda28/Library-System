<?php
session_start();
include 'db.php'; // Ensure path to your db connection is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $message = mysqli_real_escape_string($conn, $_POST['user_msg']);

    // Insert into database
    $sql = "INSERT INTO contact_inquiries (full_name, email, message) 
            VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        // Redirect with success message
        header("Location: ../contact.php?status=success");
        exit();
    } else {
        // Redirect with error
        header("Location: ../contact.php?status=error");
        exit();
    }
} else {
    header("Location: ../contact.php");
    exit();
}
?>