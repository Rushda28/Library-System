<?php
session_start();
include 'backend/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Escape the string to prevent errors with special characters
$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

// FIX 1: Added quotes around '$user_id'
$sql = "SELECT users.full_name, users.email,
               profiles.first_name, profiles.last_name,
               profiles.major, profiles.profile_pic
        FROM users
        LEFT JOIN profiles ON users.id = profiles.user_id
        WHERE users.id = '$user_id'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// 1. Total active requests (Pending or Issued - items the student is currently involved with)
$totalResQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations WHERE user_id = '$user_id' AND status IN ('pending', 'issued')");
$totalReservations = mysqli_fetch_assoc($totalResQuery)['total'];

// 2. Books currently in their possession (Borrowed/Issued)
$borrowedCountQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations WHERE user_id = '$user_id' AND status = 'issued'");
$borrowedCount = mysqli_fetch_assoc($borrowedCountQuery)['total'];

// 3. Books successfully returned (History)
$returnedCountQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations WHERE user_id = '$user_id' AND status = 'returned'");
$returnedCount = mysqli_fetch_assoc($returnedCountQuery)['total'];

$pageTitle = "Student Profile";
$customCSS = "profile.css";
include 'includes/header.php';
?>

<main class="profile-wrapper">
    <section class="profile-hero">
        <div class="profile-avatar">
            <img src="<?php echo !empty($user['profile_pic']) ? $user['profile_pic'] : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=500'; ?>" alt="Student Profile">
        </div>
        
        <div class="profile-info">
            <div class="info-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <span class="label">Academic Year 2026</span>
                    <h1>
                        <?php echo htmlspecialchars($user['first_name'] ?? 'First'); ?>
                        <span><?php echo htmlspecialchars($user['last_name'] ?? 'Name'); ?></span>
                    </h1>
                    <p>Major: <?php echo htmlspecialchars($user['major'] ?? 'Not Set'); ?></p>
                </div>
                
                <a href="logout.php" class="signout-pill">Sign Out —</a>
            </div>
            
            <a href="update-profile.php" class="edit-link">Update Profile Settings</a>
        </div>
    </section>

    <section class="profile-dashboard">
        <div class="search-box-editorial">
            <h3>Search Library <span>Resources</span></h3>
            <form action="catalog.php" method="GET" class="editorial-form">
                <input type="text" name="search" placeholder="Enter Book Title, Author or ISBN...">
                <button type="submit">Search</button>
            </form>
        </div>

       <div class="quick-stats">


    
</div>
    </section>

    <section class="account-security">
        <p class="security-note">Logged in as <?php echo htmlspecialchars($_SESSION['full_name']); ?>. Session secured.</p>
    </section>
</main>

<?php include 'includes/footer.php'; ?>