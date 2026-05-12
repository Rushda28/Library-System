<?php 
    include 'backend/db.php';

    // Get book ID from URL
    $bookID = $_GET['id'] ?? 0;

    // Fetch book from database
    $sql = "SELECT * FROM books WHERE id = $bookID";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $currentBook = mysqli_fetch_assoc($result);
    } else {
        die("Book not found.");
    }

    $pageTitle = $currentBook['title'] . " | ESSSL Library"; 
    $customCSS = "details.css"; 
    include 'includes/header.php'; 
?>

<main class="details-wrapper">

    <div class="details-container">
   <div class="book-visual">
    <?php 
    // Check if the image_url column has data
    $img = $currentBook['image_url'] ?? ''; 
    
    if(!empty($img)): 
        // Logic: If it's a web link (http), use it. If not, look in uploads folder.
        $src = (strpos($img, 'http') === 0) ? $img : "assets/uploads/" . $img;
    ?>
        <img src="<?php echo htmlspecialchars($src); ?>" 
             alt="<?php echo htmlspecialchars($currentBook['title']); ?>" 
             class="large-book-cover">
    <?php else: ?>
        <div class="large-cover-placeholder">
            <span>No Cover Available</span>
        </div>
    <?php endif; ?>
</div>

        <div class="book-text">
            <span class="status-badge available">
                <?php echo ucfirst($currentBook['status']); ?>
            </span>
            
            <h1><?php echo $currentBook['title']; ?></h1>
            <p class="author">By <span><?php echo $currentBook['author']; ?></span></p>
            
            <div class="book-meta">
                <div class="meta-item">
                    <strong>Category:</strong> <?php echo $currentBook['category']; ?>
                </div>
                <div class="meta-item">
                    <strong>ISBN:</strong> <?php echo $currentBook['isbn']; ?>
                </div>
            </div>

            <form action="backend/reserve_book.php" method="POST">
    <input type="hidden" name="book_id" value="<?php echo $currentBook['id']; ?>">
    <button type="submit" name="reserve_book" class="pill-button">
        Borrow The Book
    </button>
</form>


            <a href="catalog.php" class="back-link">← Back to Collection</a>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
