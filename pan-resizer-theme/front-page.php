<?php
/**
 * The front page template
 *
 * This is the template for the front page of the PAN Resizer application
 *
 * @package PAN_Resizer
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">PAN Card Photo, Signature & Document Resizer</h1>
        <p class="hero-description">Free online tool to resize PAN card photos, signatures and documents. Compress images to required size for NSDL/UTI PAN applications without losing quality. Quick, secure and completely free - no software installation needed.</p>
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

<?php get_footer(); ?>
