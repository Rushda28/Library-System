<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESSSL Library | <?php echo isset($pageTitle) ? $pageTitle : "System"; ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/header.css">
    
    <?php if(isset($customCSS)): ?>
    <link rel="stylesheet" href="assets/css/<?php echo $customCSS; ?>">
    <?php endif; ?>
    
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>

<nav class="main-nav">
    <a href="index.php" class="nav-logo">ESSSL <span>Library</span></a>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php" class="btn-contact">Contact</a></li>
        <li><a href="login.php" class="btn-login">Login</a></li>
    </ul>
</nav>