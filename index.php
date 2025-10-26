<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <title>PAN Card Photo Resizer - Free Online Tool for NSDL/UTI Applications</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Free online PAN card photo resizer tool. Resize photos to 40-50KB, signatures to standard dimensions, and compress documents to 200-300KB for NSDL/UTI applications. No registration required.">
    <meta name="keywords" content="PAN card photo resizer, resize PAN card photo, compress PAN photo, PAN signature resizer, NSDL photo resize, UTI photo size, free photo resizer, online image compressor, PAN document converter">
    <meta name="author" content="PAN Card Resizer">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="PAN Card Photo Resizer - Free Online Tool">
    <meta property="og:description" content="Free online PAN card photo resizer. Resize photos, compress signatures, and convert documents for NSDL/UTI applications. No registration required.">
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="PAN Card Resizer">
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="PAN Card Photo Resizer - Free Online Tool">
    <meta name="twitter:description" content="Free online PAN card photo resizer. Resize photos to 40-50KB, compress signatures, and convert documents for NSDL/UTI applications.">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#1e88e5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    
    <!-- Preconnect to required origins -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="pan-resizer-theme/assets/css/main-style.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "PAN Card Photo Resizer",
        "url": "<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",
        "description": "Free online tool to resize PAN card photos, signatures, and documents for NSDL/UTI applications",
        "applicationCategory": "UtilitiesApplication",
        "operatingSystem": "Any",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
        },
        "featureList": [
            "Resize PAN card photos to 40-50KB",
            "Compress signatures to standard size",
            "Convert documents to PDF",
            "No registration required",
            "Client-side processing for privacy"
        ]
    }
    </script>
</head>

<body>

<a href="#main-content" class="skip-to-content">Skip to content</a>

<header id="top">
    <div class="container">
        <button id="menuToggle" class="menu-toggle" aria-label="Toggle menu" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
        
        <h1 style="font-weight: 800;">Online PAN Resizer</h1>
        
        <button id="shareButton" class="share-button" aria-label="Share website" title="Share this website">
            <i class="fas fa-share-alt"></i>
        </button>
        
        <div class="mobile-menu" id="mobileMenu">
            <a href="#" onclick="scrollToSection('top')">Home</a>
            <a href="#nsdl-photo">NSDL Photo</a>
            <a href="#nsdl-signature">NSDL Signature</a>
            <a href="#uti-photo">UTI Photo</a>
            <a href="#uti-signature">UTI Signature</a>
            <a href="#custom-cm-resizer">Custom CM Resizer</a>
            <a href="#" onclick="scrollToSection('specifications')">Specifications</a>
            <a href="#" onclick="scrollToSection('features')">Key Features</a>
            <a href="#" onclick="scrollToSection('how-to-use')">How to Use</a>
            <a href="#" onclick="scrollToSection('faq')">FAQ</a>
            <a href="#" onclick="scrollToSection('privacy')">Privacy Policy</a>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">PAN Card Photo, Signature & Document Resizer</h1>
        <p class="hero-description">Free online tool to resize PAN card photos, signatures and documents. Compress images to required size for NSDL/UTI PAN applications without losing quality. Quick, secure and completely free - no software installation needed.</p>
    </div>
</section>

<main id="main-content">
    <div class="container">
        <div class="resizer-card">
            <h2>Photo, Signature & Document Editor</h2>
            <p class="seo-subtitle">Professional online tool to resize and optimize your documents</p>
            
            <?php include 'pan-resizer-theme/template-parts/pan-resizer-editor.php'; ?>
        </div>
    </div>
</main>

<!-- Preset Resizer Sections -->
<div class="container">
    <?php include 'pan-resizer-theme/template-parts/preset-resizers.php'; ?>
</div>

<?php include 'pan-resizer-theme/template-parts/specifications-section.php'; ?>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="quick-links">
                <a href="#" onclick="scrollToSection('top')">Home</a>
                <a href="#nsdl-photo">NSDL Photo</a>
                <a href="#nsdl-signature">NSDL Sign</a>
                <a href="#uti-photo">UTI Photo</a>
                <a href="#uti-signature">UTI Sign</a>
                <a href="#custom-cm-resizer">Custom CM</a>
                <a href="#" onclick="scrollToSection('specifications')">Specifications</a>
                <a href="#" onclick="scrollToSection('features')">Features</a>
                <a href="#" onclick="scrollToSection('how-to-use')">How to Use</a>
                <a href="#" onclick="scrollToSection('faq')">FAQ</a>
                <a href="#" onclick="scrollToSection('privacy')">Privacy</a>
            </div>
            <p class="copyright">
                &copy; <?php echo date('Y'); ?> PAN Card Resizer. All rights reserved. | 
                <a href="/" style="color: white; text-decoration: underline;">
                    PAN Card Resizer
                </a>
            </p>
        </div>
    </div>
</footer>

<!-- JavaScript -->
<script src="pan-resizer-theme/assets/js/main-script.js" defer></script>

</body>
</html>
