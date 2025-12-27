<?php
/**
 * Ad Injector - Handles ad placement throughout the website
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Inject Social Bar Ad
 */
function pan_resizer_ads_inject_social_bar() {
    $social_bar_code = pan_resizer_ads_get_option( 'social_bar' );
    if ( $social_bar_code ) {
        echo '<div class="pan-resizer-ad pan-resizer-ad-social-bar" style="position: fixed; left: 10px; top: 50%; transform: translateY(-50%); z-index: 999;">';
        echo wp_kses_post( $social_bar_code );
        echo '</div>';
    }
}
add_action( 'wp_footer', 'pan_resizer_ads_inject_social_bar', 5 );

/**
 * Inject Popunder Ad
 */
function pan_resizer_ads_inject_popunder() {
    $popunder_code = pan_resizer_ads_get_option( 'popunder' );
    if ( $popunder_code ) {
        echo '<div class="pan-resizer-ad pan-resizer-ad-popunder" style="display: none;">';
        echo wp_kses_post( $popunder_code );
        echo '</div>';
    }
}
add_action( 'wp_footer', 'pan_resizer_ads_inject_popunder', 10 );

/**
 * Inject Banner Ads (between sections)
 */
function pan_resizer_ads_get_banner_html() {
    $html = '';
    $banners = array( 'banner_1', 'banner_2', 'banner_3' );
    
    foreach ( $banners as $banner_key ) {
        $banner_code = pan_resizer_ads_get_option( $banner_key );
        if ( $banner_code ) {
            $html .= '<div class="pan-resizer-ad pan-resizer-ad-banner" style="text-align: center; margin: 30px 0; padding: 20px 0;">';
            $html .= wp_kses_post( $banner_code );
            $html .= '</div>';
        }
    }
    
    return $html;
}

/**
 * Inject Native Banner Ad
 */
function pan_resizer_ads_inject_native_banner() {
    $native_banner_code = pan_resizer_ads_get_option( 'native_banner' );
    if ( $native_banner_code ) {
        echo '<div class="pan-resizer-ad pan-resizer-ad-native" style="margin: 30px 0; padding: 20px; background: #f9f9f9; border-radius: 8px;">';
        echo wp_kses_post( $native_banner_code );
        echo '</div>';
    }
}

/**
 * Smart Link - Inject into header title
 */
function pan_resizer_ads_inject_smart_link() {
    $smart_link_code = pan_resizer_ads_get_option( 'smart_link_code' );
    if ( ! $smart_link_code ) {
        return;
    }
    
    // Hook into the header to wrap the "Online PAN Resizer" text with smart link code
    ob_start();
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the header text "Online PAN Resizer"
        const headerElements = document.querySelectorAll('header, .header, [role="banner"]');
        headerElements.forEach(function(header) {
            const text = header.textContent;
            if (text.includes('Online PAN Resizer')) {
                // Create smart link wrapper
                const smartLinkWrapper = document.createElement('div');
                smartLinkWrapper.className = 'pan-resizer-ad pan-resizer-ad-smart-link';
                smartLinkWrapper.innerHTML = `<?php echo wp_kses_post( $smart_link_code ); ?>`;
                header.insertBefore(smartLinkWrapper, header.firstChild);
            }
        });
    });
    </script>
    <?php
    echo ob_get_clean();
}
add_action( 'wp_footer', 'pan_resizer_ads_inject_smart_link', 15 );

/**
 * Helper function to display banner ads
 * Can be called from theme template parts
 */
function pan_resizer_ads_display_banner() {
    echo wp_kses_post( pan_resizer_ads_get_banner_html() );
}

/**
 * Helper function to display native banner
 * Can be called from theme template parts
 */
function pan_resizer_ads_display_native_banner() {
    pan_resizer_ads_inject_native_banner();
}

/**
 * Get ad option with fallback
 */
function pan_resizer_ads_get_option( $key ) {
    $options = get_option( 'pan_resizer_ads_options', array() );
    return isset( $options[ $key ] ) ? $options[ $key ] : '';
}

/**
 * Add CSS for ad styling and positioning
 */
function pan_resizer_ads_enqueue_frontend_styles() {
    $css = '
        .pan-resizer-ad {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        
        .pan-resizer-ad-social-bar {
            right: auto;
        }
        
        .pan-resizer-ad-banner {
            clear: both;
        }
        
        .pan-resizer-ad-native {
            border: 1px solid #e0e0e0;
        }
        
        @media (max-width: 768px) {
            .pan-resizer-ad-social-bar {
                position: static !important;
                transform: none !important;
                left: auto !important;
                top: auto !important;
                margin: 20px 0;
            }
        }
    ';
    
    wp_add_inline_style( 'wp-admin', $css );
}
add_action( 'wp_enqueue_scripts', 'pan_resizer_ads_enqueue_frontend_styles' );
