<?php
/**
 * Settings Page for AdStyle Ads Manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pan_resizer_ads_settings_page() {
    ?>
    <div class="wrap pan-resizer-ads-wrap">
        <h1>🎯 AdStyle Ads Manager</h1>
        <p class="description">Manage all your AdStyle ads codes in one place. Copy and paste your ad codes below.</p>
        
        <div class="ads-manager-container">
            <form method="post" action="options.php" class="ads-form">
                <?php settings_fields( 'pan_resizer_ads_options' ); ?>
                
                <div class="ads-section">
                    <h2>📍 Social Bar Ad</h2>
                    <p class="help-text">Appears on the left/right side of the website</p>
                    <textarea 
                        name="pan_resizer_ads_options[social_bar]" 
                        id="social_bar" 
                        placeholder="Paste your Social Bar ad code here..."
                        rows="6"
                    ><?php echo esc_textarea( pan_resizer_ads_get_option( 'social_bar' ) ); ?></textarea>
                </div>
                
                <div class="ads-section">
                    <h2>⬆️ Popunder Ad</h2>
                    <p class="help-text">Appears as a popup window when user interacts with the page</p>
                    <textarea 
                        name="pan_resizer_ads_options[popunder]" 
                        id="popunder" 
                        placeholder="Paste your Popunder ad code here..."
                        rows="6"
                    ><?php echo esc_textarea( pan_resizer_ads_get_option( 'popunder' ) ); ?></textarea>
                </div>
                
                <div class="ads-section">
                    <h2>📌 Banner Ads - Multiple Placements</h2>
                    <p class="help-text">Place banners between different sections and within large content areas. You can add up to 10 different banner codes.</p>
                    
                    <div class="banner-group">
                        <label for="banner_1"><strong>🔴 Banner Ad 1</strong></label>
                        <span class="position-hint">Position: Between Hero Section & All-in-One Editor</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_1]" 
                            id="banner_1" 
                            placeholder="Paste your first banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_1' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_2"><strong>🟠 Banner Ad 2</strong></label>
                        <span class="position-hint">Position: Between All-in-One Editor & Preset Resizers</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_2]" 
                            id="banner_2" 
                            placeholder="Paste your second banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_2' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_3"><strong>🟡 Banner Ad 3</strong></label>
                        <span class="position-hint">Position: Within Preset Resizers Section (middle)</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_3]" 
                            id="banner_3" 
                            placeholder="Paste your third banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_3' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_4"><strong>🟢 Banner Ad 4</strong></label>
                        <span class="position-hint">Position: Between Preset Resizers & Specifications</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_4]" 
                            id="banner_4" 
                            placeholder="Paste your fourth banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_4' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_5"><strong>🔵 Banner Ad 5</strong></label>
                        <span class="position-hint">Position: Between Specifications & Key Features</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_5]" 
                            id="banner_5" 
                            placeholder="Paste your fifth banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_5' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_6"><strong>🟣 Banner Ad 6</strong></label>
                        <span class="position-hint">Position: Within Key Features Section (middle)</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_6]" 
                            id="banner_6" 
                            placeholder="Paste your sixth banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_6' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_7"><strong>⚫ Banner Ad 7</strong></label>
                        <span class="position-hint">Position: Between Key Features & How-to-Use</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_7]" 
                            id="banner_7" 
                            placeholder="Paste your seventh banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_7' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_8"><strong>⚪ Banner Ad 8</strong></label>
                        <span class="position-hint">Position: Within How-to-Use Section (after steps)</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_8]" 
                            id="banner_8" 
                            placeholder="Paste your eighth banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_8' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_9"><strong>🟥 Banner Ad 9</strong></label>
                        <span class="position-hint">Position: Between How-to-Use & FAQ</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_9]" 
                            id="banner_9" 
                            placeholder="Paste your ninth banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_9' ) ); ?></textarea>
                    </div>
                    
                    <div class="banner-group">
                        <label for="banner_10"><strong>🟨 Banner Ad 10</strong></label>
                        <span class="position-hint">Position: Within FAQ Section (between questions)</span>
                        <textarea 
                            name="pan_resizer_ads_options[banner_10]" 
                            id="banner_10" 
                            placeholder="Paste your tenth banner ad code here..."
                            rows="5"
                        ><?php echo esc_textarea( pan_resizer_ads_get_option( 'banner_10' ) ); ?></textarea>
                    </div>
                </div>
                
                <div class="ads-section">
                    <h2>🏷️ Native Banner Ad</h2>
                    <p class="help-text">Appears as a native/integrated ad that matches your site design</p>
                    <textarea 
                        name="pan_resizer_ads_options[native_banner]" 
                        id="native_banner" 
                        placeholder="Paste your Native Banner ad code here..."
                        rows="6"
                    ><?php echo esc_textarea( pan_resizer_ads_get_option( 'native_banner' ) ); ?></textarea>
                </div>
                
                <div class="ads-section">
                    <h2>🔗 Smart Link Ad</h2>
                    <p class="help-text">
                        This code will be injected as a hyperlink to "Online PAN Resizer" text in the website header.
                        Your code should contain a hyperlink wrapper or tracking code.
                    </p>
                    <textarea 
                        name="pan_resizer_ads_options[smart_link_code]" 
                        id="smart_link_code" 
                        placeholder="Paste your Smart Link ad code here..."
                        rows="6"
                    ><?php echo esc_textarea( pan_resizer_ads_get_option( 'smart_link_code' ) ); ?></textarea>
                </div>
                
                <div class="form-actions">
                    <?php submit_button( 'Save All Ads', 'primary button-large' ); ?>
                </div>
            </form>
        </div>
        
        <div class="ads-info">
            <h3>📚 Ad Placement Guide</h3>
            <ul>
                <li><strong>Social Bar:</strong> Appears on the side of your website</li>
                <li><strong>Popunder:</strong> Appears as a popup window</li>
                <li><strong>Banners:</strong> Placed in gaps between tool sections</li>
                <li><strong>Native Banner:</strong> Integrated ad format</li>
                <li><strong>Smart Link:</strong> Linked to "Online PAN Resizer" header text</li>
            </ul>
        </div>
    </div>
    <?php
}

/**
 * Get option value safely
 */
function pan_resizer_ads_get_option( $key ) {
    $options = get_option( 'pan_resizer_ads_options', array() );
    return isset( $options[ $key ] ) ? $options[ $key ] : '';
}
