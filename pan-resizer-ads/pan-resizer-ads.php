<?php
/**
 * Plugin Name: PAN Resizer AdStyle Ads Manager
 * Plugin URI: https://panresizer.com
 * Description: Manage AdStyle ads for PAN Resizer theme
 * Version: 1.0.3
 * Author: PAN Resizer Team
 * Author URI: https://panresizer.com
 * License: GPL v2 or later
 * Text Domain: pan-resizer-ads
 * Requires at least: 5.0
 * Requires PHP: 7.2
 */

// Security check
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct access not allowed' );
}

// Register admin menu
add_action( 'admin_menu', function() {
    add_theme_page(
        'PAN Resizer Ads',
        'Ads Manager',
        'manage_options',
        'pan-resizer-ads',
        function() {
            if ( ! current_user_can( 'manage_options' ) ) {
                wp_die( 'Unauthorized' );
            }
            
            // Save form
            if ( isset( $_POST['pan_resizer_submit'] ) ) {
                check_admin_referer( 'pan_resizer_ads_nonce' );
                
                $data = array(
                    'social_bar' => isset( $_POST['social_bar'] ) ? sanitize_textarea_field( $_POST['social_bar'] ) : '',
                    'popunder' => isset( $_POST['popunder'] ) ? sanitize_textarea_field( $_POST['popunder'] ) : '',
                    'native_banner' => isset( $_POST['native_banner'] ) ? sanitize_textarea_field( $_POST['native_banner'] ) : '',
                    'smart_link' => isset( $_POST['smart_link'] ) ? sanitize_textarea_field( $_POST['smart_link'] ) : '',
                );
                
                for ( $i = 1; $i <= 10; $i++ ) {
                    $data[ 'banner_' . $i ] = isset( $_POST[ 'banner_' . $i ] ) ? sanitize_textarea_field( $_POST[ 'banner_' . $i ] ) : '';
                }
                
                update_option( 'pan_resizer_ads', $data );
                echo '<div class="notice notice-success"><p>✅ Ads saved successfully!</p></div>';
            }
            
            $ads = get_option( 'pan_resizer_ads', array() );
            ?>
            <div class="wrap">
                <h1>📱 PAN Resizer - Ads Manager</h1>
                <p>Manage all your AdStyle ads in one place. Paste your ad codes below:</p>
                
                <form method="post" style="max-width: 900px;">
                    <?php wp_nonce_field( 'pan_resizer_ads_nonce' ); ?>
                    
                    <div style="background: white; padding: 20px; border-radius: 5px; margin: 20px 0;">
                        <h2>📍 Social Bar Ad</h2>
                        <p style="color: #666;">Appears on left/right side of website</p>
                        <textarea name="social_bar" rows="5" style="width: 100%; padding: 10px; font-family: monospace;"><?php echo esc_textarea( $ads['social_bar'] ?? '' ); ?></textarea>
                    </div>
                    
                    <div style="background: white; padding: 20px; border-radius: 5px; margin: 20px 0;">
                        <h2>⬆️ Popunder Ad</h2>
                        <p style="color: #666;">Appears as popup window</p>
                        <textarea name="popunder" rows="5" style="width: 100%; padding: 10px; font-family: monospace;"><?php echo esc_textarea( $ads['popunder'] ?? '' ); ?></textarea>
                    </div>
                    
                    <div style="background: white; padding: 20px; border-radius: 5px; margin: 20px 0;">
                        <h2>🏷️ Native Banner Ad</h2>
                        <p style="color: #666;">Integrated ad format</p>
                        <textarea name="native_banner" rows="5" style="width: 100%; padding: 10px; font-family: monospace;"><?php echo esc_textarea( $ads['native_banner'] ?? '' ); ?></textarea>
                    </div>
                    
                    <div style="background: white; padding: 20px; border-radius: 5px; margin: 20px 0;">
                        <h2>🔗 Smart Link Ad</h2>
                        <p style="color: #666;">Link to header text</p>
                        <textarea name="smart_link" rows="5" style="width: 100%; padding: 10px; font-family: monospace;"><?php echo esc_textarea( $ads['smart_link'] ?? '' ); ?></textarea>
                    </div>
                    
                    <div style="background: white; padding: 20px; border-radius: 5px; margin: 20px 0;">
                        <h2>📌 Banner Ads (10 Slots)</h2>
                        <?php for ( $i = 1; $i <= 10; $i++ ) { ?>
                        <div style="margin-bottom: 20px;">
                            <h3>Banner <?php echo $i; ?></h3>
                            <textarea name="banner_<?php echo $i; ?>" rows="3" style="width: 100%; padding: 10px; font-family: monospace;"><?php echo esc_textarea( $ads[ 'banner_' . $i ] ?? '' ); ?></textarea>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <input type="hidden" name="pan_resizer_submit" value="1">
                    <button type="submit" class="button button-primary button-large" style="font-size: 16px; padding: 10px 30px;">
                        Save All Ads
                    </button>
                </form>
            </div>
            <?php
        }
    );
});

// Display ads on frontend
add_action( 'wp_footer', function() {
    $ads = get_option( 'pan_resizer_ads', array() );
    
    if ( ! empty( $ads['social_bar'] ) ) {
        echo '<div class="pan-resizer-ad-social">' . wp_kses_post( $ads['social_bar'] ) . '</div>';
    }
    if ( ! empty( $ads['popunder'] ) ) {
        echo '<div class="pan-resizer-ad-popunder">' . wp_kses_post( $ads['popunder'] ) . '</div>';
    }
    if ( ! empty( $ads['native_banner'] ) ) {
        echo '<div class="pan-resizer-ad-native">' . wp_kses_post( $ads['native_banner'] ) . '</div>';
    }
    if ( ! empty( $ads['smart_link'] ) ) {
        echo '<div class="pan-resizer-ad-smart">' . wp_kses_post( $ads['smart_link'] ) . '</div>';
    }
    
    for ( $i = 1; $i <= 10; $i++ ) {
        if ( ! empty( $ads[ 'banner_' . $i ] ) ) {
            echo '<div class="pan-resizer-ad-banner-' . $i . '">' . wp_kses_post( $ads[ 'banner_' . $i ] ) . '</div>';
        }
    }
});
