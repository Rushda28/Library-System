<?php
session_start();
include 'backend/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch profile picture
$profileQuery = mysqli_query($conn, "
    SELECT profile_pic 
    FROM profiles 
    WHERE user_id = '$user_id'
");

$profileData = mysqli_fetch_assoc($profileQuery);
$profileImage = !empty($profileData['profile_pic']) 
    ? $profileData['profile_pic'] 
    : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=500';


// Fetch user's reservations with book info
$sql = "SELECT books.title, books.category,books.image_url, reservations.reserved_at, reservations.status
        FROM reservations
        JOIN books ON reservations.book_id = books.id
        WHERE reservations.user_id = '$user_id'
        ORDER BY reservations.reserved_at DESC";

$result = mysqli_query($conn, $sql);
$totalReservations = mysqli_num_rows($result);

// 1. Total active requests (Pending Pickup)
$pendingQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations WHERE user_id = '$user_id' AND status = 'pending'");
$pendingCount = mysqli_fetch_assoc($pendingQuery)['total'];

// 2. Books currently in possession (Issued by librarian)
$issuedQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations WHERE user_id = '$user_id' AND status = 'issued'");
$borrowedCount = mysqli_fetch_assoc($issuedQuery)['total'];

// 3. Books successfully returned
$returnedQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations WHERE user_id = '$user_id' AND status = 'returned'");
$returnedHistory = mysqli_fetch_assoc($returnedQuery)['total'];

// Get all for the list below
$result = mysqli_query($conn, $sql);
$totalReservations = mysqli_num_rows($result);

$pageTitle = "My Dashboard | ESSSL Library"; 
$customCSS = "dashboard.css"; 
include 'includes/header.php'; 
?>



<main class="dashboard-wrapper">

    <header class="dashboard-header" style="display:flex; justify-content:space-between; align-items:center;">
    <div>
        <span class="welcome-label">Student Account</span>
        <h1>Welcome back, <span><?php echo $_SESSION['full_name']; ?></span></h1>
    </div>

    <div class="profile-trigger">
        <a href="profile.php" class="profile-link">
            <div class="avatar-wrapper">
                <img src="<?php echo $profileImage; ?>" alt="Profile">
            </div>
            <span class="profile-cta">View Profile →</span>
        </a>
    </div>
</header>


    <div class="dashboard-grid">
        <section class="user-books">
            <div class="section-title">
                <h3>Active Reservations</h3>
                <span class="count"><?php echo $totalReservations; ?> Book(s) Total</span>
            </div>

            <?php if($totalReservations > 0): ?>

                <?php while($row = mysqli_fetch_assoc($result)): 
    // Create a CSS-friendly class name from the category (e.g., "Fine Arts" -> "fine-arts")
    $catClass = strtolower(str_replace(' ', '-', trim($row['category'])));
    $bookImage = $row['image_url']; // The image from your database
?>

    <div class="reservation-card">
        <div class="res-visual">
        <?php 
            // 1. Determine the correct Image Source
            if(!empty($bookImage)) {
                // If it starts with http, it's a web link. Otherwise, it's in your uploads folder.
                $finalSrc = (strpos($bookImage, 'http') === 0) ? $bookImage : "assets/uploads/" . $bookImage;
            } else {
                $finalSrc = "";
            }
        ?>
           <div class="mini-cover <?php echo !empty($finalSrc) ? '' : 'cover-' . $catClass; ?>">
            <?php if(!empty($finalSrc)): ?>
                <img src="<?php echo htmlspecialchars($finalSrc); ?>" 
                     alt="Book Cover" 
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit;">
            <?php else: ?>
                <span class="initial"><?php echo substr($row['title'], 0, 1); ?></span>
            <?php endif; ?>
        </div>
    </div>
        
        <div class="res-info">
            <span class="category"><?php echo htmlspecialchars($row['category']); ?></span>
            <h4><?php echo htmlspecialchars($row['title']); ?></h4>
            <p class="res-date">
                Reserved on: <?php echo date('M d, Y', strtotime($row['reserved_at'])); ?>
            </p>
           <span class="status-tag status-<?php echo strtolower($row['status']); ?>">
    <?php 
        if($row['status'] === 'pending') echo 'Pending Pickup';
        elseif($row['status'] === 'issued') echo 'On Your Shelf';
        elseif($row['status'] === 'returned') echo 'Successfully Returned';
        else echo ucfirst($row['status']);
    ?>
</span>
        </div>
    </div>

<?php endwhile; ?>
            <?php else: ?>

                <p>No active reservations yet.</p>

            <?php endif; ?>

        </section>

        <aside class="user-stats">
            <h3>Library Status</h3>
            <div class="stat-box">
                <span class="stat-num"><?php echo $totalReservations; ?></span>
                <span class="stat-label">Books Reserved</span>
            </div>

            <div class="stat-box" style="border-left: 5px solid #705C49;">
    <span class="stat-num" style="color: #705C49;"><?php echo sprintf("%02d", $pendingCount); ?></span>
        <span class="stat-label">Pending Pickup</span>
    </div>

    <div class="stat-box" style="border-left: 4px solid #D4AF37;">
        <span class="stat-num" style="color: #D4AF37;"><?php echo sprintf("%02d", $borrowedCount); ?></span>
        <span class="stat-label">Active Borrowings</span>
    </div>

    <div class="stat-box" style="border-left: 4px solid #8D7763;">
        <span class="stat-num" style="color: #8D7763;"><?php echo sprintf("%02d", $returnedHistory); ?></span>
        <span class="stat-label">Returned Successfully</span>
    </div>
           
            <div class="stat-box promo">
                <p>Did you know? You can reserve up to 3 books at a time for your research.</p>
            </div>
        </aside>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
