<?php
session_start();
include 'backend/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

// Fetch user + profile data with quotes around the ID
$sql = "SELECT users.email, 
               profiles.first_name, 
               profiles.last_name, 
               profiles.major 
        FROM users 
        LEFT JOIN profiles ON users.id = profiles.user_id 
        WHERE users.id = '$user_id'";

$result = mysqli_query($conn, $sql);

// Check if the query actually returned a row
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Fallback so the page doesn't crash if no profile exists yet
    $user = [
        'email' => $_SESSION['email'] ?? '', 
        'first_name' => '', 
        'last_name' => '', 
        'major' => ''
    ];
}

$pageTitle = "Update Profile"; 
$customCSS = "update-profile.css"; 
include 'includes/header.php'; 
?>

<main class="settings-wrapper">
    <section class="settings-header">
        <span class="label">Personal Account</span>
        <h1>Update <span>Profile</span></h1>
        <p class="subtitle">Manage your institutional identity and contact preferences.</p>
    </section>

    <section class="settings-grid">
        <aside class="settings-nav">
            <ul>
                <li><a href="#" class="active">General Information</a></li>
                
                <li><a href="profile.php" class="back-link">← Back to Dashboard</a></li>
            </ul>
        </aside>

        <div class="settings-content">
            <form action="backend/process_profile.php" method="POST" enctype="multipart/form-data" class="editorial-form">
                
                <div class="form-group-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname"
                               value="<?php echo $user['first_name'] ?? ''; ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname"
                               value="<?php echo $user['last_name'] ?? ''; ?>"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email"
                           value="<?php echo $user['email']; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Department / Major</label>
                    <select name="major">
                        <option value="">Select Department</option>
                        <option value="architecture"
                            <?php if(($user['major'] ?? '') == 'architecture') echo 'selected'; ?>>
                            Architecture & Digital Design
                        </option>
                        <option value="business"
                            <?php if(($user['major'] ?? '') == 'business') echo 'selected'; ?>>
                            Business Management
                        </option>
                        <option value="it"
                            <?php if(($user['major'] ?? '') == 'it') echo 'selected'; ?>>
                            Information Technology
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Profile Picture</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="profile_pic" id="file-input">
                        <label for="file-input" class="file-label">Choose New Image</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="save-button">Save Changes</button>
                    <button type="reset" class="cancel-button">Discard</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
