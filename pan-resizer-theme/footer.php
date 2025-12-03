<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="quick-links">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <a href="<?php echo esc_url( home_url( '/nsdl-photo/' ) ); ?>">NSDL Photo</a>
                <a href="<?php echo esc_url( home_url( '/nsdl-signature/' ) ); ?>">NSDL Sign</a>
                <a href="<?php echo esc_url( home_url( '/uti-photo/' ) ); ?>">UTI Photo</a>
                <a href="<?php echo esc_url( home_url( '/uti-signature/' ) ); ?>">UTI Sign</a>
                <a href="<?php echo esc_url( home_url( '/custom-cm-resizer/' ) ); ?>">Custom CM</a>
                <a href="<?php echo esc_url( home_url( '/specifications/' ) ); ?>">Specifications</a>
                <a href="<?php echo esc_url( home_url( '/features/' ) ); ?>">Features</a>
                <a href="<?php echo esc_url( home_url( '/how-to-use/' ) ); ?>">How to Use</a>
                <a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a>
                <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy</a>
            </div>
            <p class="copyright">
                &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved. | 
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: white; text-decoration: underline;">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
