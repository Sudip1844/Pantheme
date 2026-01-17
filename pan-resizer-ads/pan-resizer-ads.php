<?php
/**
 * Plugin Name: PAN Resizer AdStyle Ads Manager
 * Plugin URI: https://panresizer.in
 * Description: Manage AdStyle ads for PAN Resizer theme
 * Version: 1.0.7
 * Author: PAN Resizer Team
 * Author URI: https://panresizer.in
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
        'pan_resizer_ads_page'
    );
});

// Admin styles and scripts
add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( strpos( $hook, 'pan-resizer-ads' ) === false ) {
        return;
    }
    
    wp_add_inline_style( 'wp-admin', '
        .pan-ads-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #e0e0e0;
        }
        
        .pan-ads-container h3 {
            margin-top: 0;
            color: #333;
        }
        
        .pan-ads-container .help-text {
            color: #666;
            margin-bottom: 15px;
            font-size: 13px;
        }
        
        .pan-ads-textarea {
            width: 100%;
            padding: 10px;
            font-family: monospace;
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 120px;
            resize: none;
            display: block;
        }
        
        .pan-ads-textarea:focus {
            outline: none;
            border-color: #0073aa;
            box-shadow: 0 0 0 2px rgba(0, 115, 170, 0.1);
        }
        
        .pan-ads-textarea:disabled {
            background-color: #f5f5f5;
            color: #666;
            cursor: not-allowed;
        }
        
        .pan-ads-textarea:not(:disabled):hover {
            border-color: #999;
        }
        
        .pan-ads-buttons {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        
        .pan-ads-buttons button {
            padding: 8px 16px;
            font-size: 13px;
            cursor: pointer;
            border: 1px solid #ccc;
            background: #f8f8f8;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .pan-ads-buttons .save-btn {
            background: #0073aa;
            color: white;
            border-color: #0073aa;
        }
        
        .pan-ads-buttons .save-btn:hover {
            background: #005a87;
        }
        
        .pan-ads-buttons .edit-btn {
            background: #f0f0f0;
            color: #333;
            border-color: #ccc;
        }
        
        .pan-ads-buttons .edit-btn:hover {
            background: #e8e8e8;
        }
        
        .pan-ads-buttons button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .banner-position {
            display: block;
            font-size: 12px;
            color: #0073aa;
            margin-bottom: 10px;
            font-weight: 500;
        }
        
        .form-section-title {
            margin-top: 30px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0073aa;
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }
    ' );
});

// Admin footer script for Better Reliability
add_action( 'admin_footer', function() {
    $screen = get_current_screen();
    if ( ! $screen || strpos( $screen->base, 'pan-resizer-ads' ) === false ) {
        return;
    }
    ?>
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        console.log("PAN Ads Manager: Initializing...");
        document.querySelectorAll("[data-ad-key]").forEach(function(textarea) {
            pan_init_ad_field(textarea);
        });
    });
    
    function pan_init_ad_field(textarea) {
        var key = textarea.getAttribute("data-ad-key");
        var container = textarea.closest(".pan-ads-container");
        var saveBtn = container.querySelector("[data-ad-save=\"" + key + "\"]");
        var editBtn = container.querySelector("[data-ad-edit=\"" + key + "\"]");
        
        if (!saveBtn || !editBtn) {
            console.error("PAN Ads Manager: Buttons not found for key: " + key);
            return;
        }

        function updateState() {
            var hasContent = textarea.value.trim() !== "";
            console.log("PAN Ads Manager: Updating state for " + key + ", hasContent: " + hasContent);
            
            if (hasContent) {
                textarea.disabled = true;
                saveBtn.style.display = "none";
                editBtn.style.display = "inline-block";
            } else {
                textarea.disabled = false;
                saveBtn.style.display = "inline-block";
                editBtn.style.display = "none";
            }
        }
        
        saveBtn.addEventListener("click", function(e) {
            e.preventDefault();
            var originalText = saveBtn.textContent;
            saveBtn.disabled = true;
            saveBtn.textContent = "Saving...";
            
            pan_save_ad(key, textarea.value, function() {
                saveBtn.disabled = false;
                saveBtn.textContent = originalText;
                updateState();
            });
        });
        
        editBtn.addEventListener("click", function(e) {
            e.preventDefault();
            textarea.disabled = false;
            textarea.focus();
            editBtn.style.display = "none";
            saveBtn.style.display = "inline-block";
        });
        
        updateState();
    }
    
    function pan_save_ad(key, value, callback) {
        var nonceField = document.querySelector("[name=pan_ads_nonce]");
        if (!nonceField) {
            alert("Error: Nonce field not found!");
            return;
        }

        var formData = new FormData();
        formData.append("action", "pan_save_ad");
        formData.append("key", key);
        formData.append("value", value);
        formData.append("nonce", nonceField.value);
        
        console.log("PAN Ads Manager: Saving " + key + "...");
        
        fetch(typeof ajaxurl !== "undefined" ? ajaxurl : "/wp-admin/admin-ajax.php", {
            method: "POST",
            body: formData
        })
        .then(function(r) { return r.json(); })
        .then(function(r) {
            console.log("PAN Ads Manager: Response for " + key, r);
            if (r.success) {
                // Show success message
                var msg = document.createElement("div");
                msg.style.cssText = "position:fixed;top:32px;right:20px;background:#00a32a;color:white;padding:15px 20px;border-radius:4px;box-shadow:0 2px 8px rgba(0,0,0,0.2);z-index:999999;font-size:14px;";
                msg.textContent = "✓ Ad saved successfully!";
                document.body.appendChild(msg);
                setTimeout(function() { msg.remove(); }, 3000);
                callback();
            } else {
                alert("Error saving: " + (r.data ? r.data.message : "Unknown error"));
                // Reset button if error
                var saveBtn = document.querySelector("[data-ad-save=\"" + key + "\"]");
                if (saveBtn) {
                    saveBtn.disabled = false;
                    saveBtn.textContent = "Save";
                }
            }
        })
        .catch(function(e) { 
            console.error("PAN Ads Manager: Error saving " + key, e);
            alert("Error: " + e.message); 
            var saveBtn = document.querySelector("[data-ad-save=\"" + key + "\"]");
            if (saveBtn) {
                saveBtn.disabled = false;
                saveBtn.textContent = "Save";
            }
        });
    }
    </script>
    <?php
});

// AJAX save handler
add_action( 'wp_ajax_pan_save_ad', function() {
    check_ajax_referer( 'pan_ads_nonce', 'nonce' );
    
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Unauthorized' ) );
    }
    
    $key = sanitize_key( $_POST['key'] ?? '' );
    // Use wp_unslash and don't sanitize to preserve ad code HTML/scripts
    $value = wp_unslash( $_POST['value'] ?? '' );
    
    $ads = get_option( 'pan_resizer_ads', array() );
    $ads[ $key ] = $value;
    update_option( 'pan_resizer_ads', $ads );
    
    wp_send_json_success( array( 'message' => 'Saved successfully' ) );
});

// Replace "Visit plugin site" with "View details"
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function( $links ) {
    $new_links = array();
    foreach ( $links as $link ) {
        if ( strpos( $link, 'Visit plugin site' ) !== false ) {
            $new_links[] = '<a href="' . admin_url( 'themes.php?page=pan-resizer-ads' ) . '">View Details</a>';
        } else {
            $new_links[] = $link;
        }
    }
    return $new_links;
});

// Settings page
function pan_resizer_ads_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized' );
    }
    
    $ads = get_option( 'pan_resizer_ads', array() );
    $banner_positions = array(
        'banner_1' => 'Between Hero Section & All-in-One Editor',
        'banner_2' => 'Between All-in-One Editor & Preset Resizers',
        'banner_3' => 'Within Preset Resizers Section (middle)',
        'banner_4' => 'Between Preset Resizers & Specifications',
        'banner_5' => 'Between Specifications & Key Features',
        'banner_6' => 'Within Key Features Section (middle)',
        'banner_7' => 'Between Key Features & How-to-Use',
        'banner_8' => 'Within How-to-Use Section (after steps)',
        'banner_9' => 'Between How-to-Use & FAQ',
        'banner_10' => 'Within FAQ Section (between questions)',
    );
    
    $ad_types = array(
        'social_bar' => array(
            'label' => '📍 Social Bar Ad',
            'description' => 'Appears on left/right side of website'
        ),
        'popunder' => array(
            'label' => '⬆️ Popunder Ad',
            'description' => 'Appears as popup window'
        ),
        'native_banner' => array(
            'label' => '🏷️ Native Banner Ad',
            'description' => 'Integrated ad format'
        ),
        'smart_link' => array(
            'label' => '🔗 Smart Link Ad',
            'description' => 'Link to header text'
        ),
    );
    ?>
    <div class="wrap">
        <h1>🎯 PAN Resizer - Ads Manager</h1>
        <p style="font-size: 15px; color: #666;">Manage all your AdStyle ads. Edit and save each ad individually with the Save and Edit buttons.</p>
        
        <?php wp_nonce_field( 'pan_ads_nonce', 'pan_ads_nonce' ); ?>
        
        <?php foreach ( $ad_types as $key => $type ) { ?>
        <div class="pan-ads-container">
            <h3><?php echo $type['label']; ?></h3>
            <p class="help-text"><?php echo $type['description']; ?></p>
            <textarea 
                class="pan-ads-textarea"
                data-ad-key="<?php echo $key; ?>"
                placeholder="Paste your ad code here..."
            ><?php echo esc_textarea( $ads[ $key ] ?? '' ); ?></textarea>
            <div class="pan-ads-buttons">
                <button type="button" class="save-btn" data-ad-save="<?php echo $key; ?>">Save</button>
                <button type="button" class="edit-btn" data-ad-edit="<?php echo $key; ?>">Edit</button>
            </div>
        </div>
        <?php } ?>
        
        <div class="form-section-title">📌 Banner Ads (10 Slots)</div>
        
        <?php foreach ( $banner_positions as $key => $position ) { ?>
        <div class="pan-ads-container">
            <h3><?php echo ucfirst( str_replace( '_', ' ', $key ) ); ?></h3>
            <span class="banner-position">Position: <?php echo $position; ?></span>
            <textarea 
                class="pan-ads-textarea"
                data-ad-key="<?php echo $key; ?>"
                placeholder="Paste your ad code here..."
            ><?php echo esc_textarea( $ads[ $key ] ?? '' ); ?></textarea>
            <div class="pan-ads-buttons">
                <button type="button" class="save-btn" data-ad-save="<?php echo $key; ?>">Save</button>
                <button type="button" class="edit-btn" data-ad-edit="<?php echo $key; ?>">Edit</button>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php
}

/**
 * Helper Functions for Manual Ad Placement
 */

// Get a specific ad code
function pan_get_ad( $ad_key ) {
    $ads = get_option( 'pan_resizer_ads', array() );
    return ! empty( $ads[ $ad_key ] ) ? $ads[ $ad_key ] : '';
}

// Display a banner ad
function pan_display_banner_ad( $banner_number ) {
    $ad_code = pan_get_ad( 'banner_' . $banner_number );
    if ( $ad_code ) {
        echo '<div class="pan-resizer-ad-banner-' . $banner_number . '">' . $ad_code . '</div>';
    }
}

// Wrap text with smart link ad
function pan_wrap_with_smart_link( $text ) {
    $smart_link_code = pan_get_ad( 'smart_link' );
    
    if ( empty( $smart_link_code ) ) {
        return $text;
    }
    
    // Extract the URL from smart link code (assuming it's in href="...")
    preg_match('/href=["\']([^"\']+)["\']/', $smart_link_code, $matches);
    $link_url = isset( $matches[1] ) ? $matches[1] : '';
    
    if ( $link_url ) {
        // Wrap text with the smart link
        return '<a href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener">' . $text . '</a>';
    }
    
    return $text;
}

// Get smart link wrapped hero title
function pan_get_hero_title_with_smart_link( $title ) {
    return pan_wrap_with_smart_link( $title );
}


// Display popunder ad in header for early execution
add_action( 'wp_head', function() {
    $ads = get_option( 'pan_resizer_ads', array() );
    
    if ( ! empty( $ads['popunder'] ) ) {
        echo $ads['popunder'];
    }
}, 1 ); // Priority 1 to load at start of head

// Display other ads on frontend (WordPress hook)
add_action( 'wp_footer', function() {
    $ads = get_option( 'pan_resizer_ads', array() );
    
    if ( ! empty( $ads['social_bar'] ) ) {
        echo '<div class="pan-resizer-ad-social">' . $ads['social_bar'] . '</div>';
    }
    if ( ! empty( $ads['native_banner'] ) ) {
        echo '<div class="pan-resizer-ad-native">' . $ads['native_banner'] . '</div>';
    }
    // Note: smart_link is NOT output here - it should be wrapped around hero title
    
    for ( $i = 1; $i <= 10; $i++ ) {
        pan_display_banner_ad( $i );
    }
});
