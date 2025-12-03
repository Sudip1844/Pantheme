<?php
/**
 * The front page template
 *
 * This is the template for the front page of the PAN Resizer application
 * Also handles individual tool page routes for SEO
 *
 * @package PAN_Resizer
 */

// Get current tool if on a tool page
$current_tool = pan_resizer_get_current_tool();
$tool_sections = pan_resizer_get_tool_sections();
$scroll_to_section = null;

if ( $current_tool && isset( $tool_sections[ $current_tool ] ) ) {
    $scroll_to_section = $tool_sections[ $current_tool ]['hash'];
}

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <?php if ( $current_tool ) : 
            $metadata = pan_resizer_get_section_metadata();
            $section_meta = $metadata[ $current_tool ];
        ?>
            <h1 class="hero-title"><?php echo esc_html( $section_meta['section_name'] ); ?></h1>
            <p class="hero-description"><?php echo esc_html( $section_meta['description'] ); ?></p>
        <?php else : ?>
            <h1 class="hero-title">PAN Card Photo, Signature & Document Resizer</h1>
            <p class="hero-description">Free online tool to resize PAN card photos, signatures and documents. Compress images to required size for NSDL/UTI PAN applications without losing quality. Quick, secure and completely free - no software installation needed.</p>
        <?php endif; ?>
    </div>
</section>

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

<!-- SEO Internal Links Section -->
<section class="seo-links-section" style="background: #f8f9fa; padding: 40px 0; margin-top: 40px;">
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 30px; font-size: 1.5rem; color: #333;">Quick Access to PAN Card Resizer Tools</h2>
        <div class="tool-links-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; max-width: 1000px; margin: 0 auto;">
            <?php 
            $tool_links = pan_resizer_add_tool_links();
            foreach ( $tool_links as $link ) {
                echo '<div class="tool-link-card" style="background: white; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center;">' . $link . '</div>';
            }
            ?>
        </div>
    </div>
</section>

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
