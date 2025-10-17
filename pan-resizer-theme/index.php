<?php
/**
 * The main template file
 *
 * @package PAN_Resizer
 */

get_header();
?>

<div class="container">
    <div class="resizer-card">
        <h1>PAN Card Photo, Signature & Document Resizer</h1>
        <h2 class="seo-subtitle">Best Free Online Tool to Resize PAN Card Photos Without Losing Quality</h2>
        
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                
                // Show the PAN Resizer tool
                get_template_part( 'template-parts/pan-resizer-tool' );
            endwhile;
        else :
            // Default PAN Resizer content if no page content
            get_template_part( 'template-parts/pan-resizer-tool' );
        endif;
        ?>
    </div>
</div>

<?php
get_footer();
