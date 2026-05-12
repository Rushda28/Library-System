<?php 
    $pageTitle = "Reservation Confirmed | Wardiere"; 
    $customCSS = "success.css"; 
    include 'includes/header.php'; 
?>

<main class="success-wrapper">
    <div class="success-container">
        <div class="editorial-seal">
            <svg viewBox="0 0 100 100">
                <path id="circlePath" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" fill="transparent"/>
                <text>
                    <textPath xlink:href="#circlePath">
                        ESSSL INSTITUTE • LIBRARY DIVISION • ARCHIVE SECURED •
                    </textPath>
                </text>
            </svg>
            <div class="check-icon">✓</div>
        </div>

        <section class="success-content">
            <span class="label">Reservation Confirmed</span>
            <h1>The Archive is <span>Ready</span></h1>
            <p class="success-msg">
                Your book has been successfully reserved.
                Please present your Student ID at the circulation desk within 24 hours to finalize the loan.
            </p>

            <div class="next-steps">
                <div class="step">
                    <span class="step-num">01</span>
                    <p>Visit Level 2 desk</p>
                </div>
                <div class="step">
                    <span class="step-num">02</span>
                    <p>Verify Student ID</p>
                </div>
                <div class="step">
                    <span class="step-num">03</span>
                    <p>Enjoy your reading</p>
                </div>
            </div>

            <div class="action-footer">
                <a href="dashboard.php" class="pill-button">Go to My Dashboard</a>
                <a href="catalog.php" class="secondary-link">Browse More Books</a>
            </div>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
