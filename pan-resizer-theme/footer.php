</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="quick-links">
                <a href="#" onclick="scrollToSection('top')">Home</a>
                <a href="#" onclick="scrollToSection('specifications')">Specifications</a>
                <a href="#" onclick="scrollToSection('features')">Key Features</a>
                <a href="#" onclick="scrollToSection('how-to-use')">How to Use</a>
                <a href="#" onclick="scrollToSection('faq')">FAQ</a>
                <a href="#" onclick="scrollToSection('privacy')">Privacy Policy</a>
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
