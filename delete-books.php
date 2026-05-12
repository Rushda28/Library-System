<?php
session_start();
include 'backend/db.php';

// Strict Admin Gatekeeper
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$pageTitle = "Book Inventory | ESSSL Admin"; 
$customCSS = "delete-books.css"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/css/<?php echo $customCSS; ?>">
</head>
<body class="inventory-body">

<main class="admin-wrapper">
    <header class="admin-header">
        <div class="header-text">
            
            <a href="admin.php" class="minimal-back">← Back to Dashboard</a>
            <h1>Book <span>Inventory</span></h1>
        </div>
        <div class="header-actions">
            <a href="add-book.php" class="add-btn">+ Add New Book</a>
        </div>
    </header>

    <section class="management-section">
        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title of the Work</th>
                        <th>Author</th>
                        <th>Classification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $booksQuery = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC");
                    while($book = mysqli_fetch_assoc($booksQuery)):
                    ?>
                    <tr>
                        <td class="book-title"><strong><?php echo htmlspecialchars($book['title']); ?></strong></td>
                        <td class="book-author"><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><span class="category-badge"><?php echo htmlspecialchars($book['category']); ?></span></td>
                        <td>
                            <a href="backend/delete_book.php?id=<?php echo $book['id']; ?>" 
                               onclick="return confirm('CRITICAL: Are you sure you want to permanently delete this book?');"
                               class="delete-link">Remove Entry</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>


</body>
</html>

<?php include 'admin-footer.php'; ?>




