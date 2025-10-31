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
        '1.0.2'
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
    
    // Expose SEO metadata to JavaScript for dynamic updates
    $metadata_registry = pan_resizer_get_section_metadata();
    $structured_data_map = array();
    foreach ( array( 'default', 'home-editor', 'nsdl-photo', 'nsdl-signature', 'uti-photo', 'uti-signature', 'custom-cm-resizer', 'specifications', 'features', 'how-to-use', 'faq', 'privacy' ) as $section ) {
        $structured_data_map[ $section ] = pan_resizer_get_section_structured_data( $section );
    }
    
    wp_localize_script(
        'pan-resizer-script',
        'panResizerSEO',
        array(
            'metadata' => $metadata_registry,
            'structuredData' => $structured_data_map,
            'siteUrl' => home_url( '/' )
        )
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
 * Get Section-Specific SEO Metadata Registry
 * Returns metadata for each of the 5 editor sections
 */
function pan_resizer_get_section_metadata() {
    $site_name = get_bloginfo( 'name' );
    $base_url = home_url( '/' );
    
    return array(
        'default' => array(
            'title' => 'PAN Card Photo, Signature & Document Resizer - Free Online Tool',
            'description' => 'Free online tool to resize PAN card photos, signatures and documents. Compress images to required size for NSDL/UTI PAN applications without losing quality. Quick, secure and completely free - no software installation needed.',
            'keywords' => 'PAN card photo resizer, resize PAN card photo, compress PAN photo, PAN signature resizer, NSDL photo resize, UTI photo size, free photo resizer, online image compressor, PAN document converter, custom size resizer',
            'canonical' => $base_url,
            'og_title' => 'PAN Card Photo Resizer - Free Online Tool',
            'og_url' => $base_url,
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'PAN Card Photo Resizer - Free Tool',
            'section_name' => 'PAN Card Resizer'
        ),
        'nsdl-photo' => array(
            'title' => 'NSDL (Protean) Photograph Resize - 3.5cm x 2.5cm, 200 DPI, 20 KB',
            'description' => 'Resize PAN card photograph for NSDL (Protean) requirements. Automatically resize to 3.5cm x 2.5cm at 200 DPI, compress under 20 KB. Free online tool with white background support.',
            'keywords' => 'NSDL photo resize, Protean PAN photo, NSDL photograph 3.5x2.5cm, PAN card photo 200 DPI, NSDL photo 20KB, resize photo for NSDL PAN, Protean photo resize',
            'canonical' => $base_url . '#nsdl-photo',
            'og_title' => 'NSDL (Protean) Photograph Resize - 3.5cm x 2.5cm',
            'og_url' => $base_url . '#nsdl-photo',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'NSDL Photo Resize Tool',
            'section_name' => 'NSDL Photograph Resizer'
        ),
        'nsdl-signature' => array(
            'title' => 'NSDL (Protean) Signature Resize - 2cm x 4.5cm, 200 DPI, 10 KB',
            'description' => 'Resize signature for NSDL (Protean) PAN card. Automatically resize to 2cm x 4.5cm at 200 DPI, compress under 10 KB. Free tool for perfect NSDL signature requirements.',
            'keywords' => 'NSDL signature resize, Protean PAN signature, NSDL signature 2x4.5cm, PAN card signature 200 DPI, NSDL signature 10KB, resize signature for NSDL',
            'canonical' => $base_url . '#nsdl-signature',
            'og_title' => 'NSDL (Protean) Signature Resize - 2cm x 4.5cm',
            'og_url' => $base_url . '#nsdl-signature',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'NSDL Signature Resize Tool',
            'section_name' => 'NSDL Signature Resizer'
        ),
        'uti-photo' => array(
            'title' => 'UTI/ITSL Photograph Resize - 213x213 pixels, 300 DPI, 30 KB',
            'description' => 'Resize PAN card photograph for UTI/ITSL requirements. Automatically resize to 213x213 pixels at 300 DPI, compress under 30 KB. Free online UTI photo resizer tool.',
            'keywords' => 'UTI photo resize, ITSL PAN photo, UTI photograph 213x213, PAN card photo 300 DPI, UTI photo 30KB, resize photo for UTI PAN, ITSL photo resize',
            'canonical' => $base_url . '#uti-photo',
            'og_title' => 'UTI/ITSL Photograph Resize - 213x213 pixels',
            'og_url' => $base_url . '#uti-photo',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'UTI Photo Resize Tool',
            'section_name' => 'UTI Photograph Resizer'
        ),
        'uti-signature' => array(
            'title' => 'UTI/ITSL Signature Resize - 400x200 pixels, 600 DPI, 60 KB',
            'description' => 'Resize signature for UTI/ITSL PAN card. Automatically resize to 400x200 pixels at 600 DPI, compress under 60 KB. Free tool for perfect UTI signature requirements.',
            'keywords' => 'UTI signature resize, ITSL PAN signature, UTI signature 400x200, PAN card signature 600 DPI, UTI signature 60KB, resize signature for UTI',
            'canonical' => $base_url . '#uti-signature',
            'og_title' => 'UTI/ITSL Signature Resize - 400x200 pixels',
            'og_url' => $base_url . '#uti-signature',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'UTI Signature Resize Tool',
            'section_name' => 'UTI Signature Resizer'
        ),
        'custom-cm-resizer' => array(
            'title' => 'Custom CM Resizer - Resize Images by Centimeters, DPI & File Size',
            'description' => 'Custom image resizer with precise control. Set dimensions in centimeters (cm), adjust DPI (50-1200), and specify max file size. Perfect for any document or photo resize requirements.',
            'keywords' => 'custom image resizer, resize by centimeters, cm to pixels converter, DPI resizer, custom size photo resize, precise image dimensions, resize by cm and DPI',
            'canonical' => $base_url . '#custom-cm-resizer',
            'og_title' => 'Custom CM Resizer - Resize by Centimeters & DPI',
            'og_url' => $base_url . '#custom-cm-resizer',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'Custom CM Image Resizer',
            'section_name' => 'Custom Centimeter Resizer'
        ),
        'home-editor' => array(
            'title' => 'All-in-One PAN Card Editor - Photo, Signature & PDF Resizer',
            'description' => 'Professional all-in-one PAN card editor. Resize photos, compress signatures, and optimize PDF documents for NSDL/UTI applications. Edit multiple file types in a single tool - fast, secure, and free.',
            'keywords' => 'PAN card editor, all in one photo editor, PAN signature editor, PDF resize tool, multi-purpose image resizer, document optimizer, PAN card photo editor, free online editor',
            'canonical' => $base_url . '#home-editor',
            'og_title' => 'All-in-One PAN Card Editor - Photo, Signature & PDF',
            'og_url' => $base_url . '#home-editor',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'All-in-One PAN Card Editor',
            'section_name' => 'All-in-One PAN Card Editor'
        ),
        'specifications' => array(
            'title' => 'PAN Card Photo Resize Specifications - NSDL, UTI & Custom Requirements',
            'description' => 'Complete specifications for PAN card photo and signature resizing. Detailed requirements for NSDL (Protean), UTI/ITSL formats, and custom centimeter resizing with DPI and file size guidelines.',
            'keywords' => 'PAN card specifications, NSDL photo requirements, UTI photo size, PAN signature specifications, photo resize requirements, NSDL UTI specifications',
            'canonical' => $base_url . '#specifications',
            'og_title' => 'PAN Card Photo Resize Specifications',
            'og_url' => $base_url . '#specifications',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'PAN Card Resize Specifications',
            'section_name' => 'Resize Specifications'
        ),
        'features' => array(
            'title' => 'Key Features - Free Online PAN Card Photo Resizer Tool',
            'description' => 'Discover powerful features of our PAN card resizer: instant resizing, multiple format support, client-side processing for privacy, white background support, and no registration required. Fast, secure, and completely free.',
            'keywords' => 'PAN resizer features, free photo resizer, online image compressor, instant resize, client-side processing, privacy-focused tool, no registration required',
            'canonical' => $base_url . '#features',
            'og_title' => 'PAN Card Resizer - Key Features',
            'og_url' => $base_url . '#features',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'PAN Resizer Features',
            'section_name' => 'Key Features'
        ),
        'how-to-use' => array(
            'title' => 'How to Use PAN Card Photo Resizer - Step by Step Guide',
            'description' => 'Learn how to resize PAN card photos and signatures in 3 easy steps: upload your image, adjust settings, and download the resized file. Simple step-by-step guide for NSDL and UTI applications.',
            'keywords' => 'how to resize PAN photo, PAN card photo guide, resize signature tutorial, NSDL photo upload, UTI photo resize guide, step by step resize',
            'canonical' => $base_url . '#how-to-use',
            'og_title' => 'How to Use PAN Card Photo Resizer',
            'og_url' => $base_url . '#how-to-use',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'How to Resize PAN Photo',
            'section_name' => 'How to Use Guide'
        ),
        'faq' => array(
            'title' => 'FAQ - Common Questions About PAN Card Photo Resizing',
            'description' => 'Frequently asked questions about PAN card photo resizing, signature compression, file size limits, and NSDL/UTI requirements. Get answers to all your questions about our free online resizer tool.',
            'keywords' => 'PAN card FAQ, photo resize questions, NSDL photo FAQ, UTI signature questions, image resizing help, PAN card requirements FAQ',
            'canonical' => $base_url . '#faq',
            'og_title' => 'PAN Card Photo Resizer - FAQ',
            'og_url' => $base_url . '#faq',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'PAN Resizer FAQ',
            'section_name' => 'Frequently Asked Questions'
        ),
        'privacy' => array(
            'title' => 'Privacy Policy - Your Data is Safe with Client-Side Processing',
            'description' => 'Our PAN card resizer processes all images locally in your browser. No uploads to servers, complete privacy guaranteed. Your photos and documents never leave your device.',
            'keywords' => 'privacy policy, client-side processing, secure photo resize, no upload required, data privacy, image processing privacy, local processing',
            'canonical' => $base_url . '#privacy',
            'og_title' => 'Privacy Policy - Client-Side Processing',
            'og_url' => $base_url . '#privacy',
            'og_image' => get_template_directory_uri() . '/assets/images/og-image.jpg',
            'twitter_title' => 'Privacy & Security',
            'section_name' => 'Privacy Policy'
        )
    );
}

/**
 * Detect current section from URL hash or query parameter
 */
function pan_resizer_get_current_section() {
    $section = 'default';
    
    // Check if there's a hash in the URL
    if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( $_SERVER['REQUEST_URI'], '#' ) !== false ) {
        $uri_parts = explode( '#', $_SERVER['REQUEST_URI'] );
        if ( isset( $uri_parts[1] ) ) {
            $hash = $uri_parts[1];
            $valid_sections = array( 'home-editor', 'nsdl-photo', 'nsdl-signature', 'uti-photo', 'uti-signature', 'custom-cm-resizer', 'specifications', 'features', 'how-to-use', 'faq', 'privacy' );
            if ( in_array( $hash, $valid_sections ) ) {
                $section = $hash;
            }
        }
    }
    
    // Also check for section query parameter as fallback
    if ( isset( $_GET['section'] ) ) {
        $query_section = sanitize_text_field( $_GET['section'] );
        $valid_sections = array( 'home-editor', 'nsdl-photo', 'nsdl-signature', 'uti-photo', 'uti-signature', 'custom-cm-resizer', 'specifications', 'features', 'how-to-use', 'faq', 'privacy' );
        if ( in_array( $query_section, $valid_sections ) ) {
            $section = $query_section;
        }
    }
    
    return $section;
}

/**
 * Add SEO Meta Tags with Section-Specific Content
 */
function pan_resizer_add_seo_meta_tags() {
    $site_name = get_bloginfo( 'name' );
    $current_section = pan_resizer_get_current_section();
    $metadata_registry = pan_resizer_get_section_metadata();
    $metadata = $metadata_registry[ $current_section ];
    
    ?>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo esc_attr( $metadata['description'] ); ?>">
    <meta name="keywords" content="<?php echo esc_attr( $metadata['keywords'] ); ?>">
    <meta name="author" content="<?php echo esc_attr( $site_name ); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo esc_url( $metadata['canonical'] ); ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo esc_attr( $metadata['og_title'] ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $metadata['description'] ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $metadata['og_url'] ?? $metadata['canonical'] ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <?php if ( isset( $metadata['og_image'] ) ) : ?>
    <meta property="og:image" content="<?php echo esc_url( $metadata['og_image'] ); ?>">
    <?php endif; ?>
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $metadata['twitter_title'] ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $metadata['description'] ); ?>">
    <?php if ( isset( $metadata['og_image'] ) ) : ?>
    <meta name="twitter:image" content="<?php echo esc_url( $metadata['og_image'] ); ?>">
    <?php endif; ?>
    
    <?php
}
add_action( 'wp_head', 'pan_resizer_add_seo_meta_tags', 1 );

/**
 * Get Section-Specific Structured Data
 */
function pan_resizer_get_section_structured_data( $section ) {
    $site_url = home_url( '/' );
    $metadata_registry = pan_resizer_get_section_metadata();
    $metadata = $metadata_registry[ $section ];
    
    $structured_data_configs = array(
        'default' => array(
            'name' => 'PAN Card Image Resizer',
            'description' => 'Resize PAN card photo and signature instantly for NSDL and UTI formats. Also supports custom image sizes in cm with DPI control. Free and easy to use.',
            'features' => array(
                'NSDL Photo Resize - 3.5cm x 2.5cm, 20KB',
                'NSDL Signature Resize - 2cm x 4.5cm, 10KB',
                'UTI Photo Resize - 213x213px, 30KB',
                'UTI Signature Resize - 400x200px, 60KB',
                'Custom CM Resizer with DPI control'
            )
        ),
        'nsdl-photo' => array(
            'name' => 'NSDL (Protean) Photograph Resizer',
            'description' => 'Resize PAN card photograph for NSDL (Protean) requirements. Automatically resize to 3.5cm x 2.5cm at 200 DPI, compress under 20 KB.',
            'features' => array(
                'Automatic resize to 3.5cm x 2.5cm',
                'Adjustable DPI (50-600)',
                'Compress under 20 KB',
                'White background support',
                'Client-side processing'
            )
        ),
        'nsdl-signature' => array(
            'name' => 'NSDL (Protean) Signature Resizer',
            'description' => 'Resize signature for NSDL (Protean) PAN card. Automatically resize to 2cm x 4.5cm at 200 DPI, compress under 10 KB.',
            'features' => array(
                'Automatic resize to 2cm x 4.5cm',
                'Adjustable DPI (50-600)',
                'Compress under 10 KB',
                'Black ink on white paper optimization',
                'Instant processing'
            )
        ),
        'uti-photo' => array(
            'name' => 'UTI/ITSL Photograph Resizer',
            'description' => 'Resize PAN card photograph for UTI/ITSL requirements. Fixed resize to 213x213 pixels at 300 DPI, compress under 30 KB.',
            'features' => array(
                'Fixed resize to 213x213 pixels',
                'Adjustable DPI (50-600)',
                'Compress under 30 KB',
                'White background support',
                'Free and instant'
            )
        ),
        'uti-signature' => array(
            'name' => 'UTI/ITSL Signature Resizer',
            'description' => 'Resize signature for UTI/ITSL PAN card. Fixed resize to 400x200 pixels at 600 DPI, compress under 60 KB.',
            'features' => array(
                'Fixed resize to 400x200 pixels',
                'Adjustable DPI (50-1200)',
                'Compress under 60 KB',
                'Black ink on white paper optimization',
                'High quality output'
            )
        ),
        'custom-cm-resizer' => array(
            'name' => 'Custom Centimeter Image Resizer',
            'description' => 'Custom image resizer with precise control. Set dimensions in centimeters (cm), adjust DPI (50-1200), and specify max file size.',
            'features' => array(
                'Custom dimensions in centimeters',
                'Adjustable DPI (50-1200)',
                'Custom max file size (1-500 KB)',
                'Precise cm to pixels conversion',
                'Suitable for any document'
            )
        ),
        'home-editor' => array(
            'name' => 'All-in-One PAN Card Editor',
            'description' => 'Professional all-in-one PAN card editor. Resize photos, compress signatures, and optimize PDF documents for NSDL/UTI applications. Edit multiple file types in a single tool.',
            'features' => array(
                'Edit PAN card photos',
                'Compress signatures',
                'Resize PDF documents',
                'Multi-format support (JPG, PNG, WEBP, PDF)',
                'Client-side processing for privacy',
                'No registration required'
            )
        ),
        'specifications' => array(
            'type' => 'WebPage',
            'name' => 'PAN Card Photo Resize Specifications',
            'description' => 'Complete specifications for PAN card photo and signature resizing. Detailed requirements for NSDL (Protean), UTI/ITSL formats, and custom centimeter resizing with DPI and file size guidelines.'
        ),
        'features' => array(
            'type' => 'WebPage',
            'name' => 'Key Features - PAN Card Photo Resizer',
            'description' => 'Discover powerful features of our PAN card resizer: instant resizing, multiple format support, client-side processing for privacy, white background support, and no registration required.',
            'features' => array(
                'Instant Resizing',
                'Multiple Format Support',
                'Client-Side Processing',
                'No Registration Required',
                'Free Forever'
            )
        ),
        'how-to-use' => array(
            'type' => 'HowTo',
            'name' => 'How to Resize PAN Card Photo and Signature',
            'description' => 'Learn how to resize PAN card photos and signatures in 3 easy steps: upload your image, adjust settings, and download the resized file.',
            'steps' => array(
                array('name' => 'Upload Image', 'text' => 'Select and upload your PAN card photo or signature'),
                array('name' => 'Adjust Settings', 'text' => 'Choose NSDL or UTI format, adjust DPI if needed'),
                array('name' => 'Download', 'text' => 'Click resize and download the optimized image')
            )
        ),
        'faq' => array(
            'type' => 'FAQPage',
            'name' => 'PAN Card Photo Resizer - Frequently Asked Questions',
            'description' => 'Frequently asked questions about PAN card photo resizing, signature compression, file size limits, and NSDL/UTI requirements.'
        ),
        'privacy' => array(
            'type' => 'WebPage',
            'name' => 'Privacy Policy - Client-Side Processing',
            'description' => 'Our PAN card resizer processes all images locally in your browser. No uploads to servers, complete privacy guaranteed. Your photos and documents never leave your device.'
        )
    );
    
    $config = $structured_data_configs[ $section ];
    $schema_type = isset( $config['type'] ) ? $config['type'] : 'WebApplication';
    
    // Handle different schema types
    if ( $schema_type === 'HowTo' && isset( $config['steps'] ) ) {
        $steps = array();
        $position = 1;
        foreach ( $config['steps'] as $step ) {
            $steps[] = array(
                '@type' => 'HowToStep',
                'position' => $position++,
                'name' => $step['name'],
                'text' => $step['text']
            );
        }
        
        return array(
            '@context' => 'https://schema.org',
            '@type' => 'HowTo',
            'name' => $config['name'],
            'url' => $metadata['canonical'],
            'description' => $config['description'],
            'step' => $steps
        );
    } elseif ( $schema_type === 'FAQPage' ) {
        return array(
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'name' => $config['name'],
            'url' => $metadata['canonical'],
            'description' => $config['description']
        );
    } elseif ( $schema_type === 'WebPage' ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $config['name'],
            'url' => $metadata['canonical'],
            'description' => $config['description']
        );
        
        // Add features if available
        if ( isset( $config['features'] ) && $section === 'features' ) {
            $items = array();
            $position = 1;
            foreach ( $config['features'] as $feature ) {
                $items[] = array(
                    '@type' => 'ListItem',
                    'position' => $position++,
                    'name' => $feature
                );
            }
            $schema['mainEntity'] = array(
                '@type' => 'ItemList',
                'itemListElement' => $items
            );
        }
        
        return $schema;
    } else {
        // WebApplication (default for editor tools)
        return array(
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => $config['name'],
            'url' => $metadata['canonical'],
            'applicationCategory' => 'Utility',
            'operatingSystem' => 'All',
            'offers' => array(
                '@type' => 'Offer',
                'price' => '0.00',
                'priceCurrency' => 'INR'
            ),
            'description' => $config['description'],
            'featureList' => $config['features']
        );
    }
}

/**
 * Add Structured Data (JSON-LD) with Section-Specific Content
 */
function pan_resizer_add_structured_data() {
    $current_section = pan_resizer_get_current_section();
    $structured_data = pan_resizer_get_section_structured_data( $current_section );
    
    $faq_data = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array(
            array(
                '@type' => 'Question',
                'name' => 'What is the recommended file size for a PAN card photo?',
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => 'For NSDL PAN card photos, the file size should be under 20KB with dimensions 3.5cm x 2.5cm. For UTI, it should be under 30KB with 213x213 pixels. Our tool automatically compresses your photo while maintaining quality.'
                )
            ),
            array(
                '@type' => 'Question',
                'name' => 'What DPI should I use for PAN card images?',
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => 'For NSDL photos and signatures, use 200 DPI. For UTI photos, use 300 DPI, and for UTI signatures, use 600 DPI. Our tool has these values preset, but you can adjust them if needed.'
                )
            ),
            array(
                '@type' => 'Question',
                'name' => 'Is your service really free?',
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => 'Yes, our service is completely free to use. There are no hidden charges or premium features. You can resize and compress as many files as you need. All processing is done in your browser for privacy.'
                )
            )
        )
    );
    
    echo '<script type="application/ld+json" id="schema-webapp">' . wp_json_encode( $structured_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>';
    echo '<script type="application/ld+json" id="schema-faq">' . wp_json_encode( $faq_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>';
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
