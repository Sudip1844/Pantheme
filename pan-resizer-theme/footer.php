<?php
$base_url = home_url( '/' );
$tool_sections = pan_resizer_get_tool_sections();
?>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="quick-links">
                <a href="<?php echo esc_url( $base_url ); ?>">Home</a>
                <a href="<?php echo esc_url( $base_url . $tool_sections['nsdl-photo']['slug'] . '/' ); ?>">NSDL Photo</a>
                <a href="<?php echo esc_url( $base_url . $tool_sections['nsdl-signature']['slug'] . '/' ); ?>">NSDL Sign</a>
                <a href="<?php echo esc_url( $base_url . $tool_sections['uti-photo']['slug'] . '/' ); ?>">UTI Photo</a>
                <a href="<?php echo esc_url( $base_url . $tool_sections['uti-signature']['slug'] . '/' ); ?>">UTI Sign</a>
                <a href="<?php echo esc_url( $base_url . $tool_sections['custom-cm-resizer']['slug'] . '/' ); ?>">Custom CM</a>
                <a href="#specifications">Specifications</a>
                <a href="#features">Features</a>
                <a href="#how-to-use">How to Use</a>
                <a href="#faq">FAQ</a>
                <a href="#privacy">Privacy</a>
            </div>
            <p class="copyright">
                &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved. | 
                <a href="<?php echo esc_url( $base_url ); ?>" style="color: white; text-decoration: underline;">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
