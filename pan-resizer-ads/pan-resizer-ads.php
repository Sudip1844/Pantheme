<?php
/**
 * Plugin Name: PAN Resizer AdStyle Ads Manager
 * Plugin URI: https://panresizer.com
 * Description: Manage AdStyle ads for PAN Resizer theme
 * Version: 1.0.2
 * Author: PAN Resizer Team
 * License: GPL v2 or later
 * Text Domain: pan-resizer-ads
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add settings page
add_action( 'admin_menu', function() {
    add_theme_page(
        'PAN Resizer Ads',
        'Ads Manager',
        'manage_options',
        'pan-resizer-ads',
        'pan_resizer_ads_page'
    );
});

// Settings page callback
function pan_resizer_ads_page() {
    ?>
    <div class="wrap">
        <h1>PAN Resizer - Ads Manager</h1>
        <p>Paste your AdStyle ad codes below:</p>
        
        <form method="post" action="options.php">
            <?php settings_fields( 'pan_resizer_ads_group' ); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="social_bar">Social Bar Ad</label></th>
                    <td>
                        <textarea id="social_bar" name="pan_resizer_ads[social_bar]" rows="4" cols="50" placeholder="Paste code here"><?php echo esc_textarea( get_option('pan_resizer_ads')['social_bar'] ?? '' ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="popunder">Popunder Ad</label></th>
                    <td>
                        <textarea id="popunder" name="pan_resizer_ads[popunder]" rows="4" cols="50" placeholder="Paste code here"><?php echo esc_textarea( get_option('pan_resizer_ads')['popunder'] ?? '' ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="native">Native Banner Ad</label></th>
                    <td>
                        <textarea id="native" name="pan_resizer_ads[native_banner]" rows="4" cols="50" placeholder="Paste code here"><?php echo esc_textarea( get_option('pan_resizer_ads')['native_banner'] ?? '' ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="smart">Smart Link Ad</label></th>
                    <td>
                        <textarea id="smart" name="pan_resizer_ads[smart_link]" rows="4" cols="50" placeholder="Paste code here"><?php echo esc_textarea( get_option('pan_resizer_ads')['smart_link'] ?? '' ); ?></textarea>
                    </td>
                </tr>
                <?php for ( $i = 1; $i <= 10; $i++ ) { ?>
                <tr>
                    <th scope="row"><label for="banner_<?php echo $i; ?>">Banner Ad <?php echo $i; ?></label></th>
                    <td>
                        <textarea id="banner_<?php echo $i; ?>" name="pan_resizer_ads[banner_<?php echo $i; ?>]" rows="3" cols="50" placeholder="Paste code here"><?php echo esc_textarea( get_option('pan_resizer_ads')['banner_' . $i] ?? '' ); ?></textarea>
                    </td>
                </tr>
                <?php } ?>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings
add_action( 'admin_init', function() {
    register_setting( 'pan_resizer_ads_group', 'pan_resizer_ads' );
});

// Display ads on frontend
add_action( 'wp_footer', function() {
    $ads = get_option( 'pan_resizer_ads', array() );
    
    if ( isset( $ads['social_bar'] ) && ! empty( $ads['social_bar'] ) ) {
        echo '<div class="pan-resizer-ad-social">' . wp_kses_post( $ads['social_bar'] ) . '</div>';
    }
    
    if ( isset( $ads['popunder'] ) && ! empty( $ads['popunder'] ) ) {
        echo '<div class="pan-resizer-ad-popunder">' . wp_kses_post( $ads['popunder'] ) . '</div>';
    }
    
    if ( isset( $ads['native_banner'] ) && ! empty( $ads['native_banner'] ) ) {
        echo '<div class="pan-resizer-ad-native">' . wp_kses_post( $ads['native_banner'] ) . '</div>';
    }
    
    if ( isset( $ads['smart_link'] ) && ! empty( $ads['smart_link'] ) ) {
        echo '<div class="pan-resizer-ad-smart">' . wp_kses_post( $ads['smart_link'] ) . '</div>';
    }
    
    for ( $i = 1; $i <= 10; $i++ ) {
        $key = 'banner_' . $i;
        if ( isset( $ads[$key] ) && ! empty( $ads[$key] ) ) {
            echo '<div class="pan-resizer-ad-banner-' . $i . '">' . wp_kses_post( $ads[$key] ) . '</div>';
        }
    }
});
