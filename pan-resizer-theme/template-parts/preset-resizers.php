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
        
        <div class="preset-grid">
            <div class="preset-left">
                <div class="preset-upload-area" id="upload-nsdl-photo">
                    <label class="upload-label">Upload Image</label>
                    <div class="upload-box preset-upload" data-section="nsdl-photo">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text">browse</span></p>
                        <input type="file" class="file-input" id="fileInput-nsdl-photo" accept="image/jpeg, image/png, image/webp">
                    </div>
                </div>
                
                <div class="preset-controls">
                    <div class="dpi-control">
                        <label for="dpi-nsdl-photo">DPI</label>
                        <input type="number" id="dpi-nsdl-photo" value="200" min="50" max="600" class="dpi-input">
                    </div>
                    <div class="calculated-info">
                        <span>Calculated: <strong id="calc-nsdl-photo">197px (W) x 276px (H)</strong></span><br>
                        <span>Max Size: <strong>20 KB</strong></span>
                    </div>
                </div>
                
                <div class="preset-actions">
                    <button class="resize-btn" id="resize-nsdl-photo">Resize Image</button>
                    <button class="reset-btn-preset" id="reset-nsdl-photo">Reset</button>
                </div>
            </div>
            
            <div class="preset-right">
                <div class="preview-container" id="preview-nsdl-photo">
                    <p class="preview-placeholder">Preview<br><span>Your resized image will appear here</span></p>
                    <canvas id="canvas-nsdl-photo" style="display:none;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NSDL (Protean) Signature Section -->
<section class="preset-resizer-section" id="nsdl-signature">
    <div class="resizer-card preset-card">
        <h2 class="preset-title nsdl-color">NSDL (Protean) Signature</h2>
        <p class="preset-description">Standard requirement: 2cm x 4.5cm at 200 DPI, under 10 KB. Sign with black ink on white paper. Adjust DPI if needed.</p>
        
        <div class="preset-grid">
            <div class="preset-left">
                <div class="preset-upload-area" id="upload-nsdl-signature">
                    <label class="upload-label">Upload Image</label>
                    <div class="upload-box preset-upload" data-section="nsdl-signature">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text">browse</span></p>
                        <input type="file" class="file-input" id="fileInput-nsdl-signature" accept="image/jpeg, image/png, image/webp">
                    </div>
                </div>
                
                <div class="preset-controls">
                    <div class="dpi-control">
                        <label for="dpi-nsdl-signature">DPI</label>
                        <input type="number" id="dpi-nsdl-signature" value="200" min="50" max="600" class="dpi-input">
                    </div>
                    <div class="calculated-info">
                        <span>Calculated: <strong id="calc-nsdl-signature">354px (W) x 157px (H)</strong></span><br>
                        <span>Max Size: <strong>10 KB</strong></span>
                    </div>
                </div>
                
                <div class="preset-actions">
                    <button class="resize-btn" id="resize-nsdl-signature">Resize Image</button>
                    <button class="reset-btn-preset" id="reset-nsdl-signature">Reset</button>
                </div>
            </div>
            
            <div class="preset-right">
                <div class="preview-container" id="preview-nsdl-signature">
                    <p class="preview-placeholder">Preview<br><span>Your resized image will appear here</span></p>
                    <canvas id="canvas-nsdl-signature" style="display:none;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- UTI/ITSL (UTI) Photograph Section -->
<section class="preset-resizer-section" id="uti-photo">
    <div class="resizer-card preset-card">
        <h2 class="preset-title uti-color">UTI/ITSL (UTI) Photograph</h2>
        <p class="preset-description">Fixed requirement: 213x213 pixels at 300 DPI, under 30 KB. Use a color photo with a white background.</p>
        
        <div class="preset-grid">
            <div class="preset-left">
                <div class="preset-upload-area" id="upload-uti-photo">
                    <label class="upload-label">Upload Image</label>
                    <div class="upload-box preset-upload" data-section="uti-photo">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text">browse</span></p>
                        <input type="file" class="file-input" id="fileInput-uti-photo" accept="image/jpeg, image/png, image/webp">
                    </div>
                </div>
                
                <div class="preset-controls">
                    <div class="dpi-control">
                        <label for="dpi-uti-photo">DPI</label>
                        <input type="number" id="dpi-uti-photo" value="300" readonly class="dpi-input">
                    </div>
                    <div class="calculated-info">
                        <span>Calculated: <strong id="calc-uti-photo">213px (W) x 213px (H)</strong></span><br>
                        <span>Max Size: <strong>30 KB</strong></span>
                    </div>
                </div>
                
                <div class="preset-actions">
                    <button class="resize-btn" id="resize-uti-photo">Resize Image</button>
                    <button class="reset-btn-preset" id="reset-uti-photo">Reset</button>
                </div>
            </div>
            
            <div class="preset-right">
                <div class="preview-container" id="preview-uti-photo">
                    <p class="preview-placeholder">Preview<br><span>Your resized image will appear here</span></p>
                    <canvas id="canvas-uti-photo" style="display:none;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- UTI/ITSL (UTI) Signature Section -->
<section class="preset-resizer-section" id="uti-signature">
    <div class="resizer-card preset-card">
        <h2 class="preset-title uti-color">UTI/ITSL (UTI) Signature</h2>
        <p class="preset-description">Fixed requirement: 400x200 pixels at 600 DPI, under 60 KB. Sign with black ink on white paper.</p>
        
        <div class="preset-grid">
            <div class="preset-left">
                <div class="preset-upload-area" id="upload-uti-signature">
                    <label class="upload-label">Upload Image</label>
                    <div class="upload-box preset-upload" data-section="uti-signature">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="upload-hint">Drop image here or <span class="browse-text">browse</span></p>
                        <input type="file" class="file-input" id="fileInput-uti-signature" accept="image/jpeg, image/png, image/webp">
                    </div>
                </div>
                
                <div class="preset-controls">
                    <div class="dpi-control">
                        <label for="dpi-uti-signature">DPI</label>
                        <input type="number" id="dpi-uti-signature" value="600" readonly class="dpi-input">
                    </div>
                    <div class="calculated-info">
                        <span>Calculated: <strong id="calc-uti-signature">400px (W) x 200px (H)</strong></span><br>
                        <span>Max Size: <strong>60 KB</strong></span>
                    </div>
                </div>
                
                <div class="preset-actions">
                    <button class="resize-btn" id="resize-uti-signature">Resize Image</button>
                    <button class="reset-btn-preset" id="reset-uti-signature">Reset</button>
                </div>
            </div>
            
            <div class="preset-right">
                <div class="preview-container" id="preview-uti-signature">
                    <p class="preview-placeholder">Preview<br><span>Your resized image will appear here</span></p>
                    <canvas id="canvas-uti-signature" style="display:none;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
