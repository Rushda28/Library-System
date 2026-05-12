<?php
// Local WAMP Database Credentials
$servername = "shuttle.proxy.rlwy.net";
$username = "root";
$password = "zSTukHrsAbXyQdaDocqRuTaaxuimaCKn";
$dbname = "railway";
$port = "41194";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset for language support
mysqli_set_charset($conn, "utf8mb4");
?>