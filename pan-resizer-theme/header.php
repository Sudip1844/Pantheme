<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    
    <!-- Preconnect to required origins -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    <!-- Meta tags -->
    <meta name="theme-color" content="#1e88e5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a href="#main-content" class="skip-to-content">Skip to content</a>

<header id="top">
    <div class="container">
        <button id="menuToggle" class="menu-toggle" aria-label="Toggle menu" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
        
        <h1>Online PAN Resizer</h1>
        
        <button id="shareButton" class="share-button" aria-label="Share website" title="Share this website">
            <i class="fas fa-share-alt"></i>
        </button>
        
        <div class="mobile-menu" id="mobileMenu">
            <a href="#top">Home</a>
            <a href="#specifications">Specifications</a>
            <a href="#features">Key Features</a>
            <a href="#how-to-use">How to Use</a>
            <a href="#faq">FAQ</a>
            <a href="#privacy">Privacy Policy</a>
        </div>
    </div>
</header>
