<?php
session_start();
include 'db.php';

if(isset($_POST['submit_login'])) {

    $student_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE student_id = '$student_id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] === 'admin') {
    header("Location: ../admin.php");
} else {
    header("Location: ../dashboard.php");
}
exit();


        } else {
            die("Incorrect password.");
        }

    } else {
        die("Student ID not found.");
    }
}
?>
