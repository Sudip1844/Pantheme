<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAN Card Resizer - WordPress Theme Preview</title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="pan-resizer-theme/assets/css/main-style.css" as="style">
    <link rel="preload" href="pan-resizer-theme/assets/js/main-script.js" as="script">
    
    <!-- DNS Prefetch for CDN -->
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<a href="#main-content" class="skip-to-content">Skip to content</a>

<header id="top">
    <div class="container">
        <button id="menuToggle" class="menu-toggle" aria-label="Toggle menu" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="logo">
            <h1>Online PAN Resizer</h1>
        </div>
        
        <nav id="mobileMenu" class="mobile-menu" aria-label="Main navigation">
            <button id="closeMenu" class="close-menu" aria-label="Close menu">
                <i class="fas fa-times"></i>
            </button>
            <ul>
                <li><a href="javascript:void(0)" onclick="scrollToSection('top')">Top</a></li>
                <li><a href="javascript:void(0)" onclick="scrollToSection('specifications')">Specifications</a></li>
                <li><a href="javascript:void(0)" onclick="scrollToSection('features')">Features</a></li>
                <li><a href="javascript:void(0)" onclick="scrollToSection('how-to-use')">How to Use</a></li>
                <li><a href="javascript:void(0)" onclick="scrollToSection('faq')">FAQ</a></li>
                <li><a href="javascript:void(0)" onclick="scrollToSection('privacy')">Privacy</a></li>
            </ul>
        </nav>
    </div>
</header>

<main id="main-content">
    <?php include 'pan-resizer-theme/template-parts/pan-resizer-tool.php'; ?>
</main>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="quick-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="javascript:void(0)" onclick="scrollToSection('top')">Top</a></li>
                    <li><a href="javascript:void(0)" onclick="scrollToSection('specifications')">Specifications</a></li>
                    <li><a href="javascript:void(0)" onclick="scrollToSection('features')">Features</a></li>
                    <li><a href="javascript:void(0)" onclick="scrollToSection('how-to-use')">How to Use</a></li>
                    <li><a href="javascript:void(0)" onclick="scrollToSection('faq')">FAQ</a></li>
                    <li><a href="javascript:void(0)" onclick="scrollToSection('privacy')">Privacy</a></li>
                </ul>
            </div>
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> PAN Card Resizer. All rights reserved.</p>
                <p>Free Online Tool | No Registration Required</p>
            </div>
        </div>
    </div>
</footer>

<!-- Main JavaScript -->
<script src="script.js"></script>

</body>
</html>
