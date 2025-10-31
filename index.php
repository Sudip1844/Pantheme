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
    <script type="application/ld+json" id="schema-webapp">
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
    
    <!-- SEO Metadata for JavaScript Router -->
    <script>
    <?php
    $base_url = 'https://' . $_SERVER['HTTP_HOST'];
    $metadata = array(
        'default' => array(
            'title' => 'PAN Card Photo, Signature & Document Resizer - Free Online Tool',
            'description' => 'Free online tool to resize PAN card photos, signatures and documents. Compress images to required size for NSDL/UTI PAN applications without losing quality. Quick, secure and completely free - no software installation needed.',
            'keywords' => 'PAN card photo resizer, resize PAN card photo, compress PAN photo, PAN signature resizer, NSDL photo resize, UTI photo size, free photo resizer, online image compressor, PAN document converter, custom size resizer',
            'canonical' => $base_url . '/',
            'og_title' => 'PAN Card Photo Resizer - Free Online Tool',
            'twitter_title' => 'PAN Card Photo Resizer - Free Tool'
        ),
        'nsdl-photo' => array(
            'title' => 'NSDL (Protean) Photograph Resize - 3.5cm x 2.5cm, 200 DPI, 20 KB',
            'description' => 'Resize PAN card photograph for NSDL (Protean) requirements. Automatically resize to 3.5cm x 2.5cm at 200 DPI, compress under 20 KB. Free online tool with white background support.',
            'keywords' => 'NSDL photo resize, Protean PAN photo, NSDL photograph 3.5x2.5cm, PAN card photo 200 DPI, NSDL photo 20KB, resize photo for NSDL PAN, Protean photo resize',
            'canonical' => $base_url . '/#nsdl-photo',
            'og_title' => 'NSDL (Protean) Photograph Resize - 3.5cm x 2.5cm',
            'twitter_title' => 'NSDL Photo Resize Tool'
        ),
        'nsdl-signature' => array(
            'title' => 'NSDL (Protean) Signature Resize - 2cm x 4.5cm, 200 DPI, 10 KB',
            'description' => 'Resize signature for NSDL (Protean) PAN card. Automatically resize to 2cm x 4.5cm at 200 DPI, compress under 10 KB. Free tool for perfect NSDL signature requirements.',
            'keywords' => 'NSDL signature resize, Protean PAN signature, NSDL signature 2x4.5cm, PAN card signature 200 DPI, NSDL signature 10KB, resize signature for NSDL',
            'canonical' => $base_url . '/#nsdl-signature',
            'og_title' => 'NSDL (Protean) Signature Resize - 2cm x 4.5cm',
            'twitter_title' => 'NSDL Signature Resize Tool'
        ),
        'uti-photo' => array(
            'title' => 'UTI/ITSL Photograph Resize - 213x213 pixels, 300 DPI, 30 KB',
            'description' => 'Resize PAN card photograph for UTI/ITSL requirements. Automatically resize to 213x213 pixels at 300 DPI, compress under 30 KB. Free online UTI photo resizer tool.',
            'keywords' => 'UTI photo resize, ITSL PAN photo, UTI photograph 213x213, PAN card photo 300 DPI, UTI photo 30KB, resize photo for UTI PAN, ITSL photo resize',
            'canonical' => $base_url . '/#uti-photo',
            'og_title' => 'UTI/ITSL Photograph Resize - 213x213 pixels',
            'twitter_title' => 'UTI Photo Resize Tool'
        ),
        'uti-signature' => array(
            'title' => 'UTI/ITSL Signature Resize - 400x200 pixels, 600 DPI, 60 KB',
            'description' => 'Resize signature for UTI/ITSL PAN card. Automatically resize to 400x200 pixels at 600 DPI, compress under 60 KB. Free tool for perfect UTI signature requirements.',
            'keywords' => 'UTI signature resize, ITSL PAN signature, UTI signature 400x200, PAN card signature 600 DPI, UTI signature 60KB, resize signature for UTI',
            'canonical' => $base_url . '/#uti-signature',
            'og_title' => 'UTI/ITSL Signature Resize - 400x200 pixels',
            'twitter_title' => 'UTI Signature Resize Tool'
        ),
        'custom-cm-resizer' => array(
            'title' => 'Custom CM Resizer - Resize Images by Centimeters, DPI & File Size',
            'description' => 'Custom image resizer with precise control. Set dimensions in centimeters (cm), adjust DPI (50-1200), and specify max file size. Perfect for any document or photo resize requirements.',
            'keywords' => 'custom image resizer, resize by centimeters, cm to pixels converter, DPI resizer, custom size photo resize, precise image dimensions, resize by cm and DPI',
            'canonical' => $base_url . '/#custom-cm-resizer',
            'og_title' => 'Custom CM Resizer - Resize by Centimeters & DPI',
            'twitter_title' => 'Custom CM Image Resizer'
        )
    );
    
    $structured_data = array(
        'default' => array(
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => 'PAN Card Image Resizer',
            'url' => $base_url . '/',
            'applicationCategory' => 'Utility',
            'operatingSystem' => 'All',
            'offers' => array('@type' => 'Offer', 'price' => '0.00', 'priceCurrency' => 'INR'),
            'description' => 'Resize PAN card photo and signature instantly for NSDL and UTI formats. Also supports custom image sizes in cm with DPI control. Free and easy to use.',
            'featureList' => array('NSDL Photo Resize - 3.5cm x 2.5cm, 20KB', 'NSDL Signature Resize - 2cm x 4.5cm, 10KB', 'UTI Photo Resize - 213x213px, 30KB', 'UTI Signature Resize - 400x200px, 60KB', 'Custom CM Resizer with DPI control')
        ),
        'nsdl-photo' => array(
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => 'NSDL (Protean) Photograph Resizer',
            'url' => $base_url . '/#nsdl-photo',
            'applicationCategory' => 'Utility',
            'operatingSystem' => 'All',
            'offers' => array('@type' => 'Offer', 'price' => '0.00', 'priceCurrency' => 'INR'),
            'description' => 'Resize PAN card photograph for NSDL (Protean) requirements. Automatically resize to 3.5cm x 2.5cm at 200 DPI, compress under 20 KB.',
            'featureList' => array('Automatic resize to 3.5cm x 2.5cm', 'Adjustable DPI (50-600)', 'Compress under 20 KB', 'White background support', 'Client-side processing')
        ),
        'nsdl-signature' => array(
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => 'NSDL (Protean) Signature Resizer',
            'url' => $base_url . '/#nsdl-signature',
            'applicationCategory' => 'Utility',
            'operatingSystem' => 'All',
            'offers' => array('@type' => 'Offer', 'price' => '0.00', 'priceCurrency' => 'INR'),
            'description' => 'Resize signature for NSDL (Protean) PAN card. Automatically resize to 2cm x 4.5cm at 200 DPI, compress under 10 KB.',
            'featureList' => array('Automatic resize to 2cm x 4.5cm', 'Adjustable DPI (50-600)', 'Compress under 10 KB', 'Black ink on white paper optimization', 'Instant processing')
        ),
        'uti-photo' => array(
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => 'UTI/ITSL Photograph Resizer',
            'url' => $base_url . '/#uti-photo',
            'applicationCategory' => 'Utility',
            'operatingSystem' => 'All',
            'offers' => array('@type' => 'Offer', 'price' => '0.00', 'priceCurrency' => 'INR'),
            'description' => 'Resize PAN card photograph for UTI/ITSL requirements. Fixed resize to 213x213 pixels at 300 DPI, compress under 30 KB.',
            'featureList' => array('Fixed resize to 213x213 pixels', 'Adjustable DPI (50-600)', 'Compress under 30 KB', 'White background support', 'Free and instant')
        ),
        'uti-signature' => array(
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => 'UTI/ITSL Signature Resizer',
            'url' => $base_url . '/#uti-signature',
            'applicationCategory' => 'Utility',
            'operatingSystem' => 'All',
            'offers' => array('@type' => 'Offer', 'price' => '0.00', 'priceCurrency' => 'INR'),
            'description' => 'Resize signature for UTI/ITSL PAN card. Fixed resize to 400x200 pixels at 600 DPI, compress under 60 KB.',
            'featureList' => array('Fixed resize to 400x200 pixels', 'Adjustable DPI (50-1200)', 'Compress under 60 KB', 'Black ink on white paper optimization', 'High quality output')
        ),
        'custom-cm-resizer' => array(
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => 'Custom Centimeter Image Resizer',
            'url' => $base_url . '/#custom-cm-resizer',
            'applicationCategory' => 'Utility',
            'operatingSystem' => 'All',
            'offers' => array('@type' => 'Offer', 'price' => '0.00', 'priceCurrency' => 'INR'),
            'description' => 'Custom image resizer with precise control. Set dimensions in centimeters (cm), adjust DPI (50-1200), and specify max file size.',
            'featureList' => array('Custom dimensions in centimeters', 'Adjustable DPI (50-1200)', 'Custom max file size (1-500 KB)', 'Precise cm to pixels conversion', 'Suitable for any document')
        )
    );
    
    echo 'var panResizerSEO = ' . json_encode(array(
        'metadata' => $metadata,
        'structuredData' => $structured_data,
        'siteUrl' => $base_url . '/'
    ), JSON_UNESCAPED_SLASHES) . ';';
    ?>
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
