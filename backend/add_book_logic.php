<?php
session_start();
include 'db.php';

if(isset($_POST['add_book'])) {

    // Sanitize inputs to prevent SQL Injection
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Prepare the SQL Query
    $sql = "INSERT INTO books (title, author, isbn, category) 
            VALUES ('$title', '$author', '$isbn', '$category')";

    // Execute the query
    if(mysqli_query($conn, $sql)) {
        // Redirect back to the entry page with a success flag
        header("Location: ../add-book.php?status=success");
        exit();
    } else {
        // Redirect back with an error flag
        header("Location: ../add-book.php?status=error");
        exit();
    }
}
?>