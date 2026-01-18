<?php
/**
 * Preset Resizer Sections Template Part
 * NSDL and UTI Photo/Signature Resizers
 *
 * @package PAN_Resizer
 */
?>

<!-- NSDL (Protean) Photograph Section -->
<section class="preset-resizer-section" id="nsdl-photo">
    <div class="resizer-card preset-card">
        <h2 class="preset-title nsdl-color">NSDL (Protean) Photograph</h2>
        <p class="preset-description">Standard requirement: 3.5cm x 2.5cm at 200 DPI, under 20 KB. Use a color photo with a white background. Adjust DPI if needed.</p>
        
        <div class="preset-single-column">
            <div class="preset-upload-area" id="upload-nsdl-photo">
                <label for="fileInput-nsdl-photo" class="upload-box preset-upload" data-section="nsdl-photo">
                    <div class="upload-content">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text">upload</span></p>
                        <p class="upload-file-info">JPG, PNG, WEBP • Maximum 10 MB</p>
                    </div>
                </label>
                <input type="file" class="file-input" id="fileInput-nsdl-photo" accept="image/jpeg,image/png,image/webp" style="display: none;">
                
                <div class="file-preview" id="preview-nsdl-photo" style="display: none;">
                    <!-- Preview will be added here by JavaScript -->
                </div>
            </div>
            
            <!-- Resized Image Info (shown after resize) -->
            <div class="resized-meta" id="resized-info-nsdl-photo" style="display: none;">
                <!-- Will be populated by JavaScript -->
            </div>
            
            <div class="preset-controls">
                <div class="dpi-control">
                    <label for="dpi-nsdl-photo">DPI</label>
                    <input type="number" id="dpi-nsdl-photo" value="200" min="50" max="600" class="dpi-input">
                </div>
                <div class="calculated-info">
                    <span>Output: <strong id="calc-nsdl-photo">197px (W) x 276px (H)</strong></span>
                    <span>Max Size: <strong>20 KB</strong></span>
                </div>
            </div>
            
            <div class="preset-actions">
                <button class="resize-btn" id="resize-nsdl-photo" disabled>Resize Image</button>
                <button class="download-btn-preset" id="download-nsdl-photo" style="display: none;">
                    <i class="fas fa-download"></i> Download
                </button>
                <button class="reset-btn-preset" id="reset-nsdl-photo">Reset</button>
            </div>
            
            <!-- Hidden canvas for image processing -->
            <canvas id="canvas-nsdl-photo" style="display: none;"></canvas>
        </div>
    </div>
</section>

<!-- NSDL (Protean) Signature Section -->
<section class="preset-resizer-section" id="nsdl-signature">
    <div class="resizer-card preset-card">
        <h2 class="preset-title nsdl-color">NSDL (Protean) Signature</h2>
        <p class="preset-description">Standard requirement: 2cm x 4.5cm at 200 DPI, under 10 KB. Sign with black ink on white paper. Adjust DPI if needed.</p>
        
        <div class="preset-single-column">
            <div class="preset-upload-area" id="upload-nsdl-signature">
                <label for="fileInput-nsdl-signature" class="upload-box preset-upload" data-section="nsdl-signature">
                    <div class="upload-content">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text">upload</span></p>
                        <p class="upload-file-info">JPG, PNG, WEBP • Maximum 10 MB</p>
                    </div>
                </label>
                <input type="file" class="file-input" id="fileInput-nsdl-signature" accept="image/jpeg,image/png,image/webp" style="display: none;">
                
                <div class="file-preview" id="preview-nsdl-signature" style="display: none;">
                    <!-- Preview will be added here by JavaScript -->
                </div>
            </div>
            
            <!-- Resized Image Info (shown after resize) -->
            <div class="resized-meta" id="resized-info-nsdl-signature" style="display: none;">
                <!-- Will be populated by JavaScript -->
            </div>
            
            <div class="preset-controls">
                <div class="dpi-control">
                    <label for="dpi-nsdl-signature">DPI</label>
                    <input type="number" id="dpi-nsdl-signature" value="200" min="50" max="600" class="dpi-input">
                </div>
                <div class="calculated-info">
                    <span>Output: <strong id="calc-nsdl-signature">354px (W) x 157px (H)</strong></span>
                    <span>Max Size: <strong>10 KB</strong></span>
                </div>
            </div>
            
            <div class="preset-actions">
                <button class="resize-btn" id="resize-nsdl-signature" disabled>Resize Image</button>
                <button class="download-btn-preset" id="download-nsdl-signature" style="display: none;">
                    <i class="fas fa-download"></i> Download
                </button>
                <button class="reset-btn-preset" id="reset-nsdl-signature">Reset</button>
            </div>
            
            <!-- Hidden canvas for image processing -->
            <canvas id="canvas-nsdl-signature" style="display: none;"></canvas>
        </div>
    </div>
</section>

<!-- UTI/ITSL (UTI) Photograph Section -->
<section class="preset-resizer-section" id="uti-photo">
    <div class="resizer-card preset-card">
        <h2 class="preset-title uti-color">UTI/ITSL (UTI) Photograph</h2>
        <p class="preset-description">Fixed requirement: 213x213 pixels at 300 DPI, under 30 KB. Use a color photo with a white background.</p>
        
        <div class="preset-single-column">
            <div class="preset-upload-area" id="upload-uti-photo">
                <label for="fileInput-uti-photo" class="upload-box preset-upload" data-section="uti-photo">
                    <div class="upload-content">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text">upload</span></p>
                        <p class="upload-file-info">JPG, PNG, WEBP • Maximum 10 MB</p>
                    </div>
                </label>
                <input type="file" class="file-input" id="fileInput-uti-photo" accept="image/jpeg,image/png,image/webp" style="display: none;">
                
                <div class="file-preview" id="preview-uti-photo" style="display: none;">
                    <!-- Preview will be added here by JavaScript -->
                </div>
            </div>
            
            <!-- Resized Image Info (shown after resize) -->
            <div class="resized-meta" id="resized-info-uti-photo" style="display: none;">
                <!-- Will be populated by JavaScript -->
            </div>
            
            <div class="preset-controls">
                <div class="dpi-control">
                    <label for="dpi-uti-photo">DPI</label>
                    <input type="number" id="dpi-uti-photo" value="300" min="50" max="600" class="dpi-input">
                </div>
                <div class="calculated-info">
                    <span>Output: <strong id="calc-uti-photo">213px (W) x 213px (H)</strong></span>
                    <span>Max Size: <strong>30 KB</strong></span>
                </div>
            </div>
            
            <div class="preset-actions">
                <button class="resize-btn" id="resize-uti-photo" disabled>Resize Image</button>
                <button class="download-btn-preset" id="download-uti-photo" style="display: none;">
                    <i class="fas fa-download"></i> Download
                </button>
                <button class="reset-btn-preset" id="reset-uti-photo">Reset</button>
            </div>
            
            <!-- Hidden canvas for image processing -->
            <canvas id="canvas-uti-photo" style="display: none;"></canvas>
        </div>
    </div>
</section>

<?php 
// Banner Ad 3: Within Preset Resizers Section (middle)
pan_display_ad('banner_3');
?>

<!-- UTI/ITSL (UTI) Signature Section -->
<section class="preset-resizer-section" id="uti-signature">
    <div class="resizer-card preset-card">
        <h2 class="preset-title uti-color">UTI/ITSL (UTI) Signature</h2>
        <p class="preset-description">Fixed requirement: 400x200 pixels at 600 DPI, under 60 KB. Sign with black ink on white paper.</p>
        
        <div class="preset-single-column">
            <div class="preset-upload-area" id="upload-uti-signature">
                <label for="fileInput-uti-signature" class="upload-box preset-upload" data-section="uti-signature">
                    <div class="upload-content">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text">upload</span></p>
                        <p class="upload-file-info">JPG, PNG, WEBP • Maximum 10 MB</p>
                    </div>
                </label>
                <input type="file" class="file-input" id="fileInput-uti-signature" accept="image/jpeg,image/png,image/webp" style="display: none;">
                
                <div class="file-preview" id="preview-uti-signature" style="display: none;">
                    <!-- Preview will be added here by JavaScript -->
                </div>
            </div>
            
            <!-- Resized Image Info (shown after resize) -->
            <div class="resized-meta" id="resized-info-uti-signature" style="display: none;">
                <!-- Will be populated by JavaScript -->
            </div>
            
            <div class="preset-controls">
                <div class="dpi-control">
                    <label for="dpi-uti-signature">DPI</label>
                    <input type="number" id="dpi-uti-signature" value="600" min="50" max="1200" class="dpi-input">
                </div>
                <div class="calculated-info">
                    <span>Output: <strong id="calc-uti-signature">400px (W) x 200px (H)</strong></span>
                    <span>Max Size: <strong>60 KB</strong></span>
                </div>
            </div>
            
            <div class="preset-actions">
                <button class="resize-btn" id="resize-uti-signature" disabled>Resize Image</button>
                <button class="download-btn-preset" id="download-uti-signature" style="display: none;">
                    <i class="fas fa-download"></i> Download
                </button>
                <button class="reset-btn-preset" id="reset-uti-signature">Reset</button>
            </div>
            
            <!-- Hidden canvas for image processing -->
            <canvas id="canvas-uti-signature" style="display: none;"></canvas>
        </div>
    </div>
</section>

<!-- Custom Centimeter Resizer Section -->
<section class="preset-resizer-section" id="custom-cm-resizer">
    <div class="resizer-card preset-card">
        <h2 class="preset-title custom-color">Custom Centimeter Resizer</h2>
        <p class="preset-description">Enter your desired dimensions in centimeters (cm), set the DPI, and a max file size to resize any image.</p>
        
        <!-- Info Box -->
        <div class="custom-info-box">
            <p><strong>Understanding the Conversion:</strong> The tool uses your 'cm' and 'DPI' inputs to calculate the required pixels with the formula:</p>
            <p class="formula-text">pixels = (cm / 2.54) * DPI.</p>
            <p><strong>What is DPI?</strong> DPI, or Dots Per Inch, is a crucial metric that determines the level of detail and quality an image holds. A higher DPI signifies a greater number of dots (pixels) in every inch of the image, resulting in finer details and crisper visuals. A lower DPI might lead to pixelation and reduced image quality.</p>
        </div>
        
        <!-- Input Grid -->
        <div class="custom-input-grid">
            <div class="custom-input-group">
                <div class="input-with-label">
                    <input type="number" id="custom-width" value="2.5" min="0.1" step="0.1" class="custom-input" placeholder="2.5">
                    <span class="input-label-inside">Width (cm)</span>
                </div>
            </div>
            <div class="custom-input-group">
                <div class="input-with-label">
                    <input type="number" id="custom-height" value="3.5" min="0.1" step="0.1" class="custom-input" placeholder="3.5">
                    <span class="input-label-inside">Height (cm)</span>
                </div>
            </div>
            <div class="custom-input-group">
                <div class="input-with-label">
                    <input type="number" id="custom-dpi" value="200" min="50" max="1200" class="custom-input" placeholder="200">
                    <span class="input-label-inside">Resolution (DPI)</span>
                </div>
            </div>
            <div class="custom-input-group">
                <div class="input-with-label">
                    <input type="number" id="custom-maxsize" value="20" min="1" max="500" class="custom-input" placeholder="20">
                    <span class="input-label-inside">Max Size (KB)</span>
                </div>
            </div>
        </div>
        
        <!-- Upload and Preview Area -->
        <div class="preset-single-column">
            <div class="preset-upload-area" id="upload-custom-cm">
                <label for="fileInput-custom-cm" class="upload-box preset-upload custom-upload" data-section="custom-cm">
                    <div class="upload-content">
                        <svg class="upload-icon custom-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text custom-browse">upload</span></p>
                        <p class="upload-file-info">JPG, PNG, WEBP • Maximum 10 MB</p>
                    </div>
                </label>
                <input type="file" class="file-input" id="fileInput-custom-cm" accept="image/jpeg,image/png,image/webp" style="display: none;">
                
                <div class="file-preview" id="preview-custom-cm" style="display: none;">
                    <!-- Preview will be added here by JavaScript -->
                </div>
            </div>
            
            <!-- Resized image metadata container (green box for custom filename) -->
            <div class="resized-meta" id="resized-info-custom-cm" style="display: none !important;">
                <!-- Will be populated by JavaScript after resizing -->
            </div>
            
            <div class="preset-actions">
                <button class="resize-btn custom-resize-btn" id="resize-custom-cm" disabled>Resize Image</button>
                <button class="download-btn-preset custom-resize-btn" id="download-custom-cm" style="display: none;">
                    <i class="fas fa-download"></i> Download
                </button>
                <button class="reset-btn-preset" id="reset-custom-cm">Reset</button>
            </div>
            
            <!-- Hidden canvas for image processing -->
            <canvas id="canvas-custom-cm" style="display: none;"></canvas>
        </div>
    </div>
</section>
