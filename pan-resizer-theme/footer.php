<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="quick-links">
                <a href="#top">Home</a>
                <a href="#nsdl-photo">NSDL Photo</a>
                <a href="#nsdl-signature">NSDL Sign</a>
                <a href="#uti-photo">UTI Photo</a>
                <a href="#uti-signature">UTI Sign</a>
                <a href="#custom-cm-resizer">Custom CM</a>
                <a href="#specifications">Specifications</a>
                <a href="#features">Features</a>
                <a href="#how-to-use">How to Use</a>
                <a href="#faq">FAQ</a>
                <a href="#privacy">Privacy</a>
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
