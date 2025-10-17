<?php
/**
 * PAN Card Resizer Theme Functions
 *
 * @package PAN_Resizer
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme Setup
 */
function pan_resizer_theme_setup() {
    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    
    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'pan-resizer' ),
    ) );
}
add_action( 'after_setup_theme', 'pan_resizer_theme_setup' );

/**
 * Enqueue Scripts and Styles
 */
function pan_resizer_enqueue_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 
        'pan-resizer-style', 
        get_template_directory_uri() . '/assets/css/main-style.css',
        array(),
        '1.0.0'
    );
    
    // Enqueue Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    
    // Enqueue PDF.js
    wp_enqueue_script(
        'pdf-js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js',
        array(),
        '3.11.174',
        true
    );
    
    // Enqueue jsPDF
    wp_enqueue_script(
        'jspdf',
        'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
        array(),
        '2.5.1',
        true
    );
    
    // Enqueue main script
    wp_enqueue_script(
        'pan-resizer-script',
        get_template_directory_uri() . '/assets/js/main-script.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'pan_resizer_enqueue_scripts' );

/**
 * Add async/defer to external scripts
 */
function pan_resizer_add_async_defer( $tag, $handle ) {
    $async_scripts = array( 'pdf-js', 'jspdf', 'pan-resizer-script' );
    
    if ( in_array( $handle, $async_scripts ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    
    return $tag;
}
add_filter( 'script_loader_tag', 'pan_resizer_add_async_defer', 10, 2 );

/**
 * Remove WordPress version meta tag for security
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Add SEO Meta Tags
 */
function pan_resizer_add_seo_meta_tags() {
    $site_name = get_bloginfo( 'name' );
    $current_url = wp_get_canonical_url();
    if ( ! $current_url ) {
        global $wp;
        $current_url = home_url( $wp->request );
    }
    $description = 'Free online PAN card photo resizer tool. Resize photos to 40-50KB, signatures to standard dimensions, and compress documents to 200-300KB for NSDL/UTI applications. No registration required.';
    $keywords = 'PAN card photo resizer, resize PAN card photo, compress PAN photo, PAN signature resizer, NSDL photo resize, UTI photo size, free photo resizer, online image compressor, PAN document converter';
    ?>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo esc_attr( $description ); ?>">
    <meta name="keywords" content="<?php echo esc_attr( $keywords ); ?>">
    <meta name="author" content="<?php echo esc_attr( $site_name ); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo esc_url( $current_url ); ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo esc_attr( $site_name ); ?> - Free PAN Card Photo & Signature Resizer">
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $current_url ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $site_name ); ?> - Free PAN Card Photo Resizer">
    <meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
    
    <?php
}
add_action( 'wp_head', 'pan_resizer_add_seo_meta_tags', 1 );

/**
 * Add Structured Data (JSON-LD)
 */
function pan_resizer_add_structured_data() {
    $site_name = get_bloginfo( 'name' );
    $site_url = home_url( '/' );
    
    $structured_data = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebApplication',
        'name' => $site_name,
        'url' => $site_url,
        'description' => 'Free online tool to resize PAN card photos, signatures, and documents for NSDL/UTI applications',
        'applicationCategory' => 'UtilitiesApplication',
        'operatingSystem' => 'Any',
        'offers' => array(
            '@type' => 'Offer',
            'price' => '0',
            'priceCurrency' => 'USD'
        ),
        'featureList' => array(
            'Resize PAN card photos to 40-50KB',
            'Compress signatures to standard size',
            'Convert documents to PDF',
            'No registration required',
            'Client-side processing for privacy'
        )
    );
    
    $faq_data = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array(
            array(
                '@type' => 'Question',
                'name' => 'What is the recommended file size for a PAN card photo?',
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => 'For PAN card photos, the file size should be within the 40-50KB range. Our tool automatically compresses your photo while maintaining quality to meet this requirement.'
                )
            ),
            array(
                '@type' => 'Question',
                'name' => 'Can I also resize PDFs here?',
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => 'Yes, you can resize and compress PDF documents. The tool will optimize your PDF to meet the 200-300KB size requirement while maintaining readability.'
                )
            ),
            array(
                '@type' => 'Question',
                'name' => 'Is your service really free?',
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => 'Yes, our service is completely free to use. There are no hidden charges or premium features. You can resize and compress as many files as you need.'
                )
            )
        )
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode( $structured_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>';
    echo '<script type="application/ld+json">' . wp_json_encode( $faq_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>';
}
add_action( 'wp_head', 'pan_resizer_add_structured_data', 2 );

/**
 * Add Cache Control Headers for HTML pages
 */
function pan_resizer_add_cache_headers() {
    if ( ! is_admin() && ! is_user_logged_in() ) {
        header( 'Cache-Control: public, max-age=3600, must-revalidate' );
        header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time() + 3600 ) . ' GMT' );
    }
}
add_action( 'template_redirect', 'pan_resizer_add_cache_headers', 1 );
