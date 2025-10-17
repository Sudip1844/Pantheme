<?php
/**
 * The template for displaying all pages
 *
 * @package PAN_Resizer
 */

get_header();
?>

<div class="container">
    <div class="resizer-card">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <h1>PAN Card Photo, Signature & Document Resizer</h1>
            <h2 class="seo-subtitle">Best Free Online Tool to Resize PAN Card Photos Without Losing Quality</h2>
            
            <?php
            // Always show the PAN Resizer tool
            get_template_part( 'template-parts/pan-resizer-tool' );
            ?>
        <?php
        endwhile;
        ?>
    </div>
</div>

<?php
get_footer();
