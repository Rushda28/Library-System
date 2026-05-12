<?php
session_start(); 
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php?auth=required");
    exit();
}
include 'backend/db.php';

$sql = "SELECT * FROM books ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$isLoggedIn = isset($_SESSION['user_id']); 

$pageTitle = "The Collection | ESSSL Library"; 
$customCSS = "catalog.css"; 
include 'includes/header.php'; 
?>

<main class="catalog-wrapper">
    <header class="catalog-header">
        <span class="category-label">Academic Archives</span>
        <h1>The <span>Collection</span></h1>
        <p>Explore our curated library of engineering, science, and arts.</p>
    </header>

    <a href="dashboard.php" class="floating-profile-btn">
        <span class="icon">👤</span> My Profile
    </a>

    <div class="book-grid">
    <?php 
    if (mysqli_num_rows($result) > 0) {
        while($book = mysqli_fetch_assoc($result)) { 
            $categorySlug = strtolower(trim($book['category']));
            $categorySlug = str_replace(' ', '-', $categorySlug);
            $coverClass = "cover-" . $categorySlug;
    ?>
        <div class="book-card">
            <div class="book-cover-placeholder">
                <?php 
                $img = $book['image_url']; 
                if(!empty($img)): 
                    $src = (strpos($img, 'http') === 0) ? $img : "assets/uploads/" . $img;
                ?>
                    <img src="<?php echo htmlspecialchars($src); ?>" 
                         alt="Cover" 
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit;">
                <?php else: ?>
                    <div class="<?php echo $coverClass; ?>" style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                        <span class="dept-tag"><?php echo htmlspecialchars($book['category']); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="book-info">
                <h4><?php echo htmlspecialchars($book['title']); ?></h4>
                <p>By <?php echo htmlspecialchars($book['author']); ?></p>
                
                <?php if($isLoggedIn): ?>
                    <a href="book-details.php?id=<?php echo $book['id']; ?>" class="borrow-btn">View Book</a>
                <?php else: ?>
                    <a href="login.php" onclick="return showLoginPrompt(event, this.href)" class="borrow-btn">View Book</a>
                <?php endif; ?>
            </div>
        </div>
    <?php 
        } 
    } else {
        echo "<p class='no-books'>No books found in the collection.</p>";
    }
    ?>
    </div> 
</main>

<script>
function showLoginPrompt(e, url) {
    if(e && e.preventDefault) e.preventDefault();
    var response = confirm("Member Access Only!\n\nYou need to be logged in to view book details. Would you like to login now?");
    if (response) {
        window.location.href = url;
    }
    return false;
}
</script>

<?php include 'includes/footer.php'; ?>