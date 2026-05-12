
<?php 
    $pageTitle = "Contact Support"; 
    $customCSS = "contact.css"; 
    include 'includes/header.php'; 
?>

<main class="contact-wrapper">

<?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="status-msg success-toast">
            <p>Thank you! Your inquiry has been received. Our team will contact you soon.</p>
        </div>
    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
        <div class="status-msg error-toast">
            <p>Something went wrong. Please try again later.</p>
        </div>
    <?php endif; ?>
    <section class="contact-hero">
        <div class="hero-label">Get in Touch</div>
        <h1>Contact <span>Us</span></h1>
        <p class="subtitle">Have a question? Our librarians are here to help.</p>
    </section>

    <div class="contact-container">
        <div class="contact-card">
            <form class="contact-form" action="backend/send_mail.php" method="POST">
                <div class="input-group">
                    <label>Your Name</label>
                    <input type="text" name="full_name" placeholder="Enter your full name" required>
                </div>
                
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="user_email" placeholder="student@esssl.edu" required>
                </div>
                
                <div class="input-group">
                    <label>Message</label>
                    <textarea name="user_msg" rows="6" placeholder="How can we assist you today?" required></textarea>
                </div>
                
                <button type="submit" class="pill-button">Submit Inquiry</button>
            </form>
        </div>

        <div class="contact-info">
            <h3>Library Hours</h3>
            <p>Monday - Friday: 8:00 AM - 6:00 PM</p>
            <p>Saturday: 9:00 AM - 2:00 PM</p>
            
            <h3 style="margin-top: 30px;">Location</h3>
            <p>ESSSL Institute Main Campus,<br>Colombo, Sri Lanka</p>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>