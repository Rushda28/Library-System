<?php 
    $pageTitle = "Welcome to our Digital Library"; 
    $customCSS = "index.css"; 
    include 'includes/header.php'; 
?>

<main class="home-wrapper">
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <span class="establishment">Est. 2026 | ESSSL Institute</span>
                <h1>THE MODERN <span>LIBRARY</span></h1>
                <p>Welcome to a space where knowledge meets innovation. Browse our curated collection of academic resources and manage your borrowing experience seamlessly.</p>
                
                <div class="cta-group">
                    <a href="catalog.php" class="pill-button">Browse Catalog</a>
                   
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="feature-card">
                    <div class="feature-image"></div>
                    <div class="feature-info">
                        <h3>Curated Collection</h3>
                        <p>Access over 5,000 titles across engineering, science, and the arts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="catalog-preview">
        <div class="preview-header">
            <h2>Latest <span>Additions</span></h2>
            <a href="catalog.php" class="view-all">View Collection</a>
        </div>
        <div class="preview-grid">
    <div class="preview-item">
        <div class="book-placeholder img-arch"></div> <h4>Modern Architecture</h4>
        <p>Engineering Dept.</p>
    </div>

    <div class="preview-item">
        <div class="book-placeholder img-digital"></div> <h4>Digital Innovation</h4>
        <p>Technology Dept.</p>
    </div>

    <div class="preview-item">
        <div class="book-placeholder img-art"></div> <h4>The Art of Design</h4>
        <p>Fine Arts Dept.</p>
    </div>
</div>
        </div>
    </section>

    <section class="editorial-section">
    <div class="editorial-text-wrap">
        <span class="editorial-label">Our Services</span>
        <h2 class="editorial-title">The Modern <span>Experience</span></h2>
    </div>

    <div class="editorial-dark-box">
        <div class="editorial-item">
            <span class="editorial-no">01</span>
            <h4>Fast Borrowing</h4>
            <p>Automated dispensing for a contactless experience.</p>
        </div>
        <div class="editorial-item">
            <span class="editorial-no">02</span>
            <h4>Digital Access</h4>
            <p>Reserve books online from your student dashboard.</p>
        </div>
        <div class="editorial-item">
            <span class="editorial-no">03</span>
            <h4>24/7 Support</h4>
            <p>Dedicated librarians ready to assist your research.</p>
        </div>
    </div>
</section>
</main>

<?php include 'includes/footer.php'; ?>