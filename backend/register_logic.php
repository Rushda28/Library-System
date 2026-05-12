<?php
include 'db.php';

if(isset($_POST['register_user'])) {

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (full_name, student_id, email, password)
            VALUES ('$full_name', '$student_id', '$email', '$hashed_password')";

    if(mysqli_query($conn, $sql)) {
        header("Location: ../login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
