<?php
/**
 * The front page template
 *
 * This is the template for the front page of the PAN Resizer application
 * Also handles individual tool page routes for SEO
 *
 * @package PAN_Resizer
 */

// Get current section from URL
$current_section = pan_resizer_get_current_section();
$scroll_to_section = null;

// Map section to hash for scrolling
$section_to_hash = array(
    'nsdl-photo' => 'nsdl-photo',
    'nsdl-signature' => 'nsdl-signature',
    'uti-photo' => 'uti-photo',
    'uti-signature' => 'uti-signature',
    'custom-cm-resizer' => 'custom-cm-resizer',
    'home-editor' => 'home-editor',
    'pan-card-editor' => 'home-editor',
    'specifications' => 'specifications',
    'features' => 'features',
    'how-to-use' => 'how-to-use',
    'faq' => 'faq',
    'privacy' => 'privacy'
);

if ( $current_section !== 'default' && isset( $section_to_hash[ $current_section ] ) ) {
    $scroll_to_section = $section_to_hash[ $current_section ];
}

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <?php if ( $current_section !== 'default' ) : 
            $metadata = pan_resizer_get_section_metadata();
            $section_meta = isset($metadata[ $current_section ]) ? $metadata[ $current_section ] : $metadata['default'];
        ?>
            <h1 class="hero-title"><?php echo function_exists('pan_wrap_with_smart_link') ? pan_wrap_with_smart_link( esc_html( $section_meta['section_name'] ) ) : esc_html( $section_meta['section_name'] ); ?></h1>
            <p class="hero-description"><?php echo esc_html( $section_meta['description'] ); ?></p>
        <?php else : ?>
            <h1 class="hero-title"><?php echo function_exists('pan_wrap_with_smart_link') ? pan_wrap_with_smart_link( 'PAN Card Photo, Signature & Document Resizer' ) : 'PAN Card Photo, Signature & Document Resizer'; ?></h1>
            <p class="hero-description">Free online tool to resize PAN card photos, signatures and documents. Compress images to required size for NSDL/UTI PAN applications without losing quality. Quick, secure and completely free - no software installation needed.</p>
        <?php endif; ?>
    </div>
</section>

<?php 
// Banner Ad 1: Between Hero Section & All-in-One Editor
if ( function_exists('pan_display_banner_ad') ) {
    pan_display_banner_ad( 1 );
}
?>

<main id="main-content">
    <div class="container">
        <div class="resizer-card" id="home-editor">
            <h2 class="editor-title">All-in-One PAN Card Editor</h2>
            <h3 class="editor-subtitle">Photo, Signature & Document Resizer Tool</h3>
            <p class="seo-subtitle">Professional online tool to resize and optimize your PAN card images and documents. Edit photos, signatures, and PDFs - all in one place!</p>
            
            <?php get_template_part( 'template-parts/pan-resizer-editor' ); ?>
        </div>
    </div>
</main>

<!-- Preset Resizer Sections -->
<div class="container">
    <?php get_template_part( 'template-parts/preset-resizers' ); ?>
</div>

<?php get_template_part( 'template-parts/specifications-section' ); ?>

<?php if ( $scroll_to_section ) : ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var targetSection = document.getElementById('<?php echo esc_js( $scroll_to_section ); ?>');
    if (targetSection) {
        setTimeout(function() {
            targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 300);
    }
});
</script>
<?php endif; ?>

<?php get_footer(); ?>
