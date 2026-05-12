<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$first_name = mysqli_real_escape_string($conn, $_POST['fname']);
$last_name  = mysqli_real_escape_string($conn, $_POST['lname']);
$email      = mysqli_real_escape_string($conn, $_POST['email']);
$major      = mysqli_real_escape_string($conn, $_POST['major']);

$profile_pic_path = "";

// Handle image upload
if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {

    $upload_dir = "../uploads/";
    if(!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = time() . "_" . basename($_FILES['profile_pic']['name']);
    $target_file = $upload_dir . $file_name;

    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file);

    $profile_pic_path = "uploads/" . $file_name;
}

// Check if email already exists for another user
$emailCheck = mysqli_query($conn, 
    "SELECT id FROM users WHERE email='$email' AND id != $user_id"
);

if(mysqli_num_rows($emailCheck) > 0) {
    die("This email is already used by another account.");
}

// Update email
mysqli_query($conn, "UPDATE users SET email='$email' WHERE id=$user_id");


// Check if profile exists
$checkProfile = mysqli_query($conn, "SELECT * FROM profiles WHERE user_id=$user_id");

if(mysqli_num_rows($checkProfile) > 0) {

    // Update existing profile
    $sql = "UPDATE profiles 
            SET first_name='$first_name',
                last_name='$last_name',
                major='$major'";

    if($profile_pic_path != "") {
        $sql .= ", profile_pic='$profile_pic_path'";
    }

    $sql .= " WHERE user_id=$user_id";

} else {

    // Insert new profile
    $sql = "INSERT INTO profiles (user_id, first_name, last_name, major, profile_pic)
            VALUES ('$user_id', '$first_name', '$last_name', '$major', '$profile_pic_path')";
}

mysqli_query($conn, $sql);

header("Location: ../profile.php");
exit();
?>
