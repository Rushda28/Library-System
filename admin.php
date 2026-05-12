<?php
session_start();
include 'backend/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin-login.php");
    exit();
}

// Get total books
$totalBooksQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM books");
$totalBooks = mysqli_fetch_assoc($totalBooksQuery)['total'];

// Get total active reservations
$totalResQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM reservations");
$totalReservations = mysqli_fetch_assoc($totalResQuery)['total'];

// Get reservations with user + book info
$reservationsQuery = mysqli_query($conn, "
    SELECT reservations.id as res_id, users.full_name, users.student_id, 
           books.title, reservations.reserved_at, reservations.status
    FROM reservations
    JOIN users ON reservations.user_id = users.id
    JOIN books ON reservations.book_id = books.id
    ORDER BY reservations.reserved_at DESC
");

$pageTitle = "Librarian Portal | ESSSL Admin"; 
$customCSS = "admin.css"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/css/<?php echo $customCSS; ?>">
</head>
<body class="admin-page">

<main class="admin-wrapper">
    <header class="admin-header">
        <div class="header-text">
            <span class="admin-badge">Staff Access</span>
            <h1>Library <span>Control Center</span></h1>
        </div>
        <div class="header-actions">
            <a href="add-book.php" class="add-btn">+ Add New Book</a>
            <a href="delete-books.php" class="manage-btn">Delete a book</a>
            <a href="logout.php" class="logout-link">Sign Out</a>
        </div>
    </header>

    <div class="admin-stats">
        <div class="stat-card">
            <span class="label">Total Collection</span>
            <span class="value"><?php echo $totalBooks; ?></span>
        </div>
        <div class="stat-card">
            <span class="label">Active Reserves</span>
            <span class="value"><?php echo $totalReservations; ?></span>
        </div>
    </div>

    <section class="management-section">
        <div class="section-header">
            <h3>Recent Reservations</h3>
            <p>Review and confirm student book pickups.</p>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Student Details</th>
                        <th>Book Selection</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
    <?php if(mysqli_num_rows($reservationsQuery) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($reservationsQuery)): ?>
            <tr>
                <td>
                    <strong><?php echo $row['full_name']; ?></strong><br>
                    <small>ID: <?php echo $row['student_id']; ?></small>
                </td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo date('M d, Y', strtotime($row['reserved_at'])); ?></td>
                <td>
                    <span class="badge <?php echo strtolower($row['status']); ?>">
                        <?php echo ucfirst($row['status']); ?>
                    </span>
                </td>
                <td class="manage-cell">
                    <?php if ($row['status'] === 'pending'): ?>
                        <form action="backend/update-reservation.php" method="POST">
                            <input type="hidden" name="res_id" value="<?php echo $row['res_id']; ?>">
                            <button type="submit" name="action" value="issue" class="confirm-btn">Issue Book</button>
                        </form>
                    <?php elseif ($row['status'] === 'issued'): ?>
                        <form action="backend/update-reservation.php" method="POST">
                            <input type="hidden" name="res_id" value="<?php echo $row['res_id']; ?>">
                            <button type="submit" name="action" value="return" class="confirm-btn return-btn">Mark Returned</button>
                        </form>
                    <?php else: ?>
                        <span class="status-done">✓ Completed</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="empty-msg">No active reservations found.</td>
        </tr>
    <?php endif; ?>
</tbody>
            </table>
        </div>
    </section>
</main>


</body>
</html>

<?php include 'admin-footer.php'; ?>
