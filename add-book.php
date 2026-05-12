<?php
session_start();

// Strict Admin Gatekeeper
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin-login.php");
    exit();
}

$pageTitle = "Archive New Entry | ESSSL"; 
$customCSS = "add-book.css"; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/css/<?php echo $customCSS; ?>">
</head>
<body class="entry-body">

<main class="entry-wrapper">
    <div class="back-navigation">
        <a href="admin.php" class="minimal-back">← Return to Control Center</a>
    </div>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'success'): ?>
            <div class="alert-msg success-box">
                <p><strong>✓ Success:</strong> The new Book has been registered in the archive.</p>
            </div>
        <?php elseif ($_GET['status'] == 'error'): ?>
            <div class="alert-msg error-box">
                <p><strong>✕ Error:</strong> System failed to register the entry. Please check the data.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <section class="entry-form-container">
        <header class="entry-header">
            <span class="label">Library Registry</span>
            <h1>Add to the <span>Collection</span></h1>
            <p>Enter the metadata for the new archival addition.</p>
        </header>

        <form class="studio-form" action="backend/add_book_logic.php" method="POST">
            <div class="input-block">
                <label>Work Title</label>
                <input type="text" name="title" placeholder="e.g. The Great Gatsby" required>
            </div>
            
            <div class="input-block">
                <label>Lead Author</label>
                <input type="text" name="author" placeholder="e.g. F. Scott Fitzgerald" required>
            </div>

            <div class="input-row">
                <div class="input-block">
                    <label>ISBN-13</label>
                    <input type="text" name="isbn" placeholder="978-...">
                </div>
                <div class="input-block">
                    <label>Classification</label>
                    <select name="category" required>
                        <option value="" disabled selected>Select Category</option>
                        <option>Fine Arts</option>
                        <option>Architecture</option>
                        <option>Literature</option>
                        <option>History</option>
                        <option>Science</option>
                    </select>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" name="add_book" class="submit-entry">Register Entry —</button>
            </div>
        </form>
    </section>
</main>


</body>
</html>

<?php include 'admin-footer.php'; ?>
