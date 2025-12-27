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
            
            <!-- Our Other Tools Section -->
            <div class="footer-other-tools">
                <a href="https://qrcodegenerator.example.com" class="other-tools-btn" target="_blank" rel="noopener noreferrer">
                    📱 QR Code Generator & Scanner
                </a>
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

<style>
    .footer-other-tools {
        margin: 20px 0;
    }
    
    .other-tools-btn {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 12px 24px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    
    .other-tools-btn:hover {
        background-color: #45a049;
        color: white;
        text-decoration: none;
    }
</style>

<?php wp_footer(); ?>

</body>
</html>
