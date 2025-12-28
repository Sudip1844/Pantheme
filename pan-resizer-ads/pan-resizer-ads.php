<?php
/**
 * Plugin Name: PAN Resizer AdStyle Ads Manager
 * Plugin URI: https://panresizer.com
 * Description: Manage AdStyle ads (Social Bar, Popunder, Banners, Native Banner, Smart Links) for PAN Resizer theme
 * Version: 1.0.1
 * Author: PAN Resizer Team
 * Author URI: https://panresizer.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: pan-resizer-ads
 * Requires at least: 5.0
 * Requires PHP: 7.4
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'PAN_RESIZER_ADS_VERSION', '1.0.0' );
define( 'PAN_RESIZER_ADS_PATH', plugin_dir_path( __FILE__ ) );
define( 'PAN_RESIZER_ADS_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files
require_once PAN_RESIZER_ADS_PATH . 'includes/ad-injector.php';
require_once PAN_RESIZER_ADS_PATH . 'admin/settings-page.php';

/**
 * Initialize the plugin
 */
function pan_resizer_ads_init() {
    // Register settings
    register_setting( 'pan_resizer_ads_options', 'pan_resizer_ads_options' );
    
    // Add admin menu
    add_action( 'admin_menu', 'pan_resizer_ads_add_admin_menu' );
    
    // Enqueue admin styles
    add_action( 'admin_enqueue_scripts', 'pan_resizer_ads_enqueue_admin_scripts' );
}
add_action( 'init', 'pan_resizer_ads_init' );

/**
 * Add admin menu
 */
function pan_resizer_ads_add_admin_menu() {
    // Add as submenu under Appearance (which always exists)
    add_theme_page(
        'PAN Resizer Ads Manager',
        'Ads Manager',
        'manage_options',
        'pan-resizer-ads-manager',
        'pan_resizer_ads_settings_page'
    );
}

/**
 * Enqueue admin scripts and styles
 */
function pan_resizer_ads_enqueue_admin_scripts( $hook ) {
    if ( 'appearance_page_pan-resizer-ads-manager' !== $hook ) {
        return;
    }
    
    wp_enqueue_style( 'pan-resizer-ads-admin', PAN_RESIZER_ADS_URL . 'admin/admin-style.css' );
}

/**
 * Activation hook - set default options
 */
function pan_resizer_ads_activate() {
    $default_options = array(
        'social_bar' => '',
        'popunder' => '',
        'banner_1' => '',
        'banner_2' => '',
        'banner_3' => '',
        'banner_4' => '',
        'banner_5' => '',
        'banner_6' => '',
        'banner_7' => '',
        'banner_8' => '',
        'banner_9' => '',
        'banner_10' => '',
        'native_banner' => '',
        'smart_link_code' => '',
    );
    
    if ( ! get_option( 'pan_resizer_ads_options' ) ) {
        add_option( 'pan_resizer_ads_options', $default_options );
    }
}
register_activation_hook( __FILE__, 'pan_resizer_ads_activate' );

/**
 * Deactivation hook
 */
function pan_resizer_ads_deactivate() {
    // Clean up if needed
}
register_deactivation_hook( __FILE__, 'pan_resizer_ads_deactivate' );
