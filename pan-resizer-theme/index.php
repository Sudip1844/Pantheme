<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package PAN_Resizer
 */

get_header();
?>

<main id="main-content">

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">PAN Card Photo, Signature & Document Resizer</h1>
        <p class="hero-description">Free online tool to resize PAN card photos, signatures and documents. Compress images to required size for NSDL/UTI PAN applications without losing quality. Quick, secure and completely free - no software installation needed.</p>
    </div>
</section>

<section class="editor-section">
    <div class="container">
        <div class="resizer-card">
            <h2>Photo, Signature & Document Editor</h2>
            <p class="seo-subtitle">Professional online tool to resize and optimize your documents</p>
            
            <?php get_template_part( 'template-parts/pan-resizer-editor' ); ?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/specifications-section' ); ?>

</main>

<?php get_footer(); ?>
