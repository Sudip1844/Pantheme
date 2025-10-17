<?php
/**
 * PAN Resizer Tool Template Part
 *
 * @package PAN_Resizer
 */
?>

<!-- Step 1: File Upload -->
<div class="upload-container" id="step1Container">
    <div class="upload-box" id="dropZone">
        <i class="fas fa-cloud-upload-alt"></i>
        <p class="upload-text">Drag & drop or click to select file</p>
        <p class="supported-formats">Supported formats: jpg/jpeg, png, pdf (Max size: 10MB)</p>
        <button class="choose-file-btn" id="chooseFileBtn">Choose File</button>
        <input type="file" id="fileInput" accept=".jpg,.jpeg,.png,.pdf" hidden aria-label="Choose file">
    </div>

    <div class="file-preview" id="filePreview" style="display: none;">
        <!-- File preview will be added here by JavaScript -->
    </div>

    <div class="action-buttons">
        <button class="reset-btn" id="resetBtn">
            <i class="fas fa-sync-alt"></i> Reset All
        </button>
        <button class="next-btn" id="nextBtn" disabled>
            Next <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<!-- Step 2: Choose Document Type -->
<div class="type-selection-container" id="step2Container" style="display: none;">
    <h3 class="step-title">Type</h3>

    <div class="type-options">
        <label class="type-option">
            <input type="radio" name="docType" value="photo" checked>
            <span class="type-card">
                <i class="fas fa-user"></i>
                <span>Photo</span>
            </span>
        </label>

        <label class="type-option">
            <input type="radio" name="docType" value="signature">
            <span class="type-card">
                <i class="fas fa-signature"></i>
                <span>Signature</span>
            </span>
        </label>

        <label class="type-option">
            <input type="radio" name="docType" value="document">
            <span class="type-card">
                <i class="fas fa-file-alt"></i>
                <span>Document</span>
            </span>
        </label>
    </div>

    <div class="action-buttons">
        <button class="back-btn" id="backBtn">
            <i class="fas fa-chevron-left"></i> Back
        </button>
        <button class="next-btn" id="step2NextBtn">
            Next <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<!-- Step 3: Photo Editor -->
<div class="editor-container" id="photoEditorContainer" style="display: none;">
    <h3 class="step-title">Photo Editor</h3>

    <div class="editor-wrapper">
        <div class="image-container">
            <div class="image-canvas-container" id="photoCanvasContainer">
                <!-- Canvas will be added here by JavaScript -->
            </div>
        </div>

        <div class="editor-controls">
            <div class="control-group">
                <button class="control-btn" id="photoRotateLeftBtn">
                    <i class="fas fa-undo"></i> Rotate Left
                </button>
                <button class="control-btn" id="photoRotateRightBtn">
                    <i class="fas fa-redo"></i> Rotate Right
                </button>
            </div>

            <div class="control-group">
                <label class="control-label">Zoom:</label>
                <input type="range" class="control-slider" id="photoZoomSlider" min="100" max="200" value="100">
            </div>

            <div class="control-group">
                <label class="control-label">Brightness:</label>
                <input type="range" class="control-slider" id="photoBrightnessSlider" min="0" max="200" value="100">
            </div>

            <div class="control-group">
                <label class="control-label">Contrast:</label>
                <input type="range" class="control-slider" id="photoContrastSlider" min="0" max="200" value="100">
            </div>

            <div class="control-group">
                <button class="control-btn" id="photoResetBtn">
                    <i class="fas fa-sync-alt"></i> Reset Filters
                </button>
            </div>

            <div class="control-group">
                <button class="download-btn" id="photoDownloadBtn">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>

    <div class="size-info">
        <p class="size-text">Output will be optimized for PAN card requirements</p>
    </div>

    <div class="action-buttons">
        <button class="back-btn" id="photoBackBtn">
            <i class="fas fa-chevron-left"></i> Back
        </button>
        <button class="preview-btn" id="photoPreviewBtn">
            <i class="fas fa-eye"></i> Preview
        </button>
    </div>
</div>

<!-- Step 3: Signature Editor -->
<div class="editor-container" id="signatureEditorContainer" style="display: none;">
    <h3 class="step-title">Signature Editor</h3>

    <div class="editor-wrapper">
        <div class="image-container">
            <div class="image-canvas-container" id="signatureCanvasContainer">
                <!-- Canvas will be added here by JavaScript -->
            </div>
        </div>

        <div class="editor-controls">
            <div class="control-group">
                <button class="control-btn" id="signatureRotateLeftBtn">
                    <i class="fas fa-undo"></i> Rotate Left
                </button>
                <button class="control-btn" id="signatureRotateRightBtn">
                    <i class="fas fa-redo"></i> Rotate Right
                </button>
            </div>

            <div class="control-group">
                <label class="control-label">Zoom:</label>
                <input type="range" class="control-slider" id="signatureZoomSlider" min="100" max="200" value="100">
            </div>

            <div class="control-group">
                <label class="control-label">Brightness:</label>
                <input type="range" class="control-slider" id="signatureBrightnessSlider" min="0" max="200" value="100">
            </div>

            <div class="control-group">
                <label class="control-label">Contrast:</label>
                <input type="range" class="control-slider" id="signatureContrastSlider" min="0" max="200" value="100">
            </div>

            <div class="control-group">
                <button class="control-btn" id="signatureResetBtn">
                    <i class="fas fa-sync-alt"></i> Reset Filters
                </button>
            </div>

            <div class="control-group">
                <button class="download-btn" id="signatureDownloadBtn">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>

    <div class="size-info">
        <p class="size-text">Output will be optimized for PAN card requirements</p>
    </div>

    <div class="action-buttons">
        <button class="back-btn" id="signatureBackBtn">
            <i class="fas fa-chevron-left"></i> Back
        </button>
        <button class="preview-btn" id="signaturePreviewBtn">
            <i class="fas fa-eye"></i> Preview
        </button>
    </div>
</div>

<!-- Step 3: Document Editor -->
<div class="editor-container" id="documentEditorContainer" style="display: none;">
    <h3 class="step-title">Document Editor</h3>

    <div class="editor-wrapper">
        <div class="image-container">
            <div class="image-canvas-container" id="documentCanvasContainer">
                <!-- Canvas will be added here by JavaScript -->
            </div>
        </div>

        <div class="editor-controls">
            <div class="control-group">
                <button class="control-btn" id="documentCropBtn">
                    <i class="fas fa-crop"></i> Crop
                </button>
                <button class="control-btn" id="documentRotateLeftBtn">
                    <i class="fas fa-undo"></i> Rotate Left
                </button>
                <button class="control-btn" id="documentRotateRightBtn">
                    <i class="fas fa-redo"></i> Rotate Right
                </button>
            </div>

            <div class="control-group">
                <label class="control-label">Zoom:</label>
                <input type="range" class="control-slider" id="documentZoomSlider" min="50" max="200" value="100">
            </div>

            <div class="control-group">
                <label class="control-label">Brightness:</label>
                <input type="range" class="control-slider" id="documentBrightnessSlider" min="0" max="200" value="100">
            </div>

            <div class="control-group">
                <label class="control-label">Contrast:</label>
                <input type="range" class="control-slider" id="documentContrastSlider" min="0" max="200" value="100">
            </div>

            <div class="control-group">
                <button class="control-btn" id="documentBackBtn">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <button class="control-btn" id="documentResetBtn">
                    <i class="fas fa-sync-alt"></i> Reset
                </button>
                <button class="control-btn" id="documentPreviewBtn">
                    <i class="fas fa-eye"></i> Preview
                </button>
                <button class="download-btn" id="documentDownloadBtn">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <button class="back-btn" id="documentBackBtn">
            <i class="fas fa-chevron-left"></i> Back
        </button>
        <button class="preview-btn" id="documentPreviewBtn">
            <i class="fas fa-eye"></i> Preview
        </button>
    </div>
</div>

<!-- Specifications Section -->
<section id="specifications" class="specifications-section">
    <div class="container">
        <h2 class="specs-title">Specifications</h2>
        <div class="specs-container">
            <!-- Photo Specifications Card -->
            <div class="specs-card photo-specs">
                <div class="specs-header">
                    <i class="fas fa-user"></i>
                    <h3>PAN Card Photo Specifications & Resizer</h3>
                </div>
                <ul class="specs-list">
                    <li><i class="fas fa-check"></i> 2.5 x 3.5 cm (Standard PAN Card Photo Size)</li>
                    <li><i class="fas fa-check"></i> 200 DPI Quality Preservation</li>
                    <li><i class="fas fa-check"></i> 40-50KB Size Range Compression</li>
                    <li><i class="fas fa-check"></i> JPEG Format Conversion</li>
                    <li><i class="fas fa-check"></i> Perfect for NSDL & UTI Applications</li>
                </ul>
            </div>

            <!-- Signature Specifications Card -->
            <div class="specs-card signature-specs">
                <div class="specs-header">
                    <i class="fas fa-signature"></i>
                    <h3>PAN Card Signature Resizer & Compressor</h3>
                </div>
                <ul class="specs-list">
                    <li><i class="fas fa-check"></i> 4.5 x 2.5 cm (Standard PAN Signature Size)</li>
                    <li><i class="fas fa-check"></i> 200 DPI High Resolution</li>
                    <li><i class="fas fa-check"></i> 40-50KB Size Range Optimization</li>
                    <li><i class="fas fa-check"></i> JPEG Format for Official Submission</li>
                    <li><i class="fas fa-check"></i> Instant Signature Resizing Online</li>
                </ul>
            </div>

            <!-- Document Requirements Card -->
            <div class="specs-card document-specs">
                <div class="specs-header">
                    <i class="fas fa-file-alt"></i>
                    <h3>PAN Card Document Size Reducer & Converter</h3>
                </div>
                <ul class="specs-list">
                    <li><i class="fas fa-check"></i> PDF Output Format Conversion</li>
                    <li><i class="fas fa-check"></i> 200-300KB Size Compression</li>
                    <li><i class="fas fa-check"></i> Clear & Readable Quality Preservation</li>
                    <li><i class="fas fa-check"></i> Auto-Compressed for PAN Applications</li>
                    <li><i class="fas fa-check"></i> Document Format Conversion for NSDL/UTI</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Key Features Section -->
<section id="features" class="key-features-section">
    <div class="container">
        <h2 class="features-title">Key Features of Our Free PAN Card Photo & Signature Resizer</h2>
        <p class="features-description">Our platform offers comprehensive tools to resize, compress, and convert your photos, signatures, and documents for PAN card applications without losing quality</p>

        <div class="features-container">
            <!-- Advanced Image Editing -->
            <div class="feature-card">
                <div class="feature-icon" style="background-color: #e6efff;">
                    <i class="fas fa-pen" style="color: #4a89ff;"></i>
                </div>
                <div class="feature-content">
                    <h3>Advanced Image Editing</h3>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Precise Zoom Control</li>
                        <li><i class="fas fa-check"></i> 360° Rotation</li>
                        <li><i class="fas fa-check"></i> Brightness Adjustment</li>
                        <li><i class="fas fa-check"></i> Contrast Control</li>
                    </ul>
                </div>
            </div>

            <!-- Smart Compression -->
            <div class="feature-card">
                <div class="feature-icon" style="background-color: #f8f0ff;">
                    <i class="fas fa-compress-arrows-alt" style="color: #a366ff;"></i>
                </div>
                <div class="feature-content">
                    <h3>Smart Compression</h3>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Automatic Size Reduction</li>
                        <li><i class="fas fa-check"></i> Quality Preservation</li>
                        <li><i class="fas fa-check"></i> NSDL Compliant Output</li>
                        <li><i class="fas fa-check"></i> UTI Compatible Output</li>
                    </ul>
                </div>
            </div>

            <!-- Multiple Format Support -->
            <div class="feature-card">
                <div class="feature-icon" style="background-color: #e6fff0;">
                    <i class="fas fa-file-alt" style="color: #4cd471;"></i>
                </div>
                <div class="feature-content">
                    <h3>Multiple Format Support</h3>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> JPEG Processing</li>
                        <li><i class="fas fa-check"></i> PNG Support</li>
                        <li><i class="fas fa-check"></i> PDF Conversion</li>
                        <li><i class="fas fa-check"></i> Auto Format Detection</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How to Use Section -->
<section id="how-to-use" class="how-to-use-section" style="padding: 60px 0; background-color: #f5f7f8;">
    <div class="container">
        <h2 class="features-title">How to Resize PAN Card Photos & Compress Signatures for Online Applications?</h2>
        <p class="features-description">Simple step-by-step guide to resize your PAN card photos without losing quality and compress signatures to the perfect size</p>
        <div class="how-to-steps" style="max-width: 800px; margin: 40px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="step-item" style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                <div class="step-number" style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">1</div>
                <p style="margin: 0; color: #333; font-size: 16px;">Open file by clicking on Select file button.</p>
            </div>
            <div class="step-item" style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                <div class="step-number" style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">2</div>
                <p style="margin: 0; color: #333; font-size: 16px;">Choose your requirement according to your application website and file type.</p>
            </div>
            <div class="step-item" style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                <div class="step-number" style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">3</div>
                <p style="margin: 0; color: #333; font-size: 16px;">Adjust a photo in crop box to remove unwanted object and adjust brightness and contrast if you want.</p>
            </div>
            <div class="step-item" style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                <div class="step-number" style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">4</div>
                <p style="margin: 0; color: #333; font-size: 16px;">Once a photo is edited, click on the download button to download file.</p>
            </div>
            <div class="step-item" style="display: flex; align-items: flex-start;">
                <div class="step-number" style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">5</div>
                <p style="margin: 0; color: #333; font-size: 16px;">After download, you can upload this resized and compress file to your online PAN Card application form.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="faq-section" style="padding: 60px 0; background-color: #fff;">
    <div class="container">
        <h2 class="features-title">Frequently Asked Questions About PAN Card Photo Resizer</h2>
        <p class="features-description">Find answers to common questions about resizing PAN card photos, compressing signatures, and converting documents for UTI/NSDL applications</p>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What is the recommended file size for a PAN card photo?</h3>
                    <span class="toggle-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>For PAN card photos, the file size should be within the 40-50KB range. Our tool automatically compresses your photo while maintaining quality to meet this requirement.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can I also resize PDFs here?</h3>
                    <span class="toggle-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Yes, you can resize and compress PDF documents. The tool will optimize your PDF to meet the 200-300KB size requirement while maintaining readability.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Is your service really free?</h3>
                    <span class="toggle-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Yes, our service is completely free to use. There are no hidden charges or premium features. You can resize and compress as many files as you need.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Do I need to install any software?</h3>
                    <span class="toggle-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>No, our tool works entirely in your web browser. There's no need to download or install any additional software.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Privacy Policy Section -->
<section id="privacy" class="privacy-section" style="padding: 60px 0; background-color: #f5f7f8;">
    <div class="container">
        <h2 class="features-title">Privacy Policy</h2>
        <div class="privacy-content" style="max-width: 800px; margin: 0 auto;">
            <div class="privacy-card" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <h5 style="color: #333; font-size: 20px; margin-bottom: 15px;">Your Privacy Matters</h5>
                <p style="color: #666; margin-bottom: 20px;">We do not store, share, or upload any files you process. All operations happen locally in your browser.</p>

                <h5 style="color: #333; font-size: 20px; margin-bottom: 15px; margin-top: 30px;">Data Handling</h5>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px; color: #666;"><i class="fas fa-check" style="color: #3b82f6; margin-right: 10px;"></i> No server-side processing</li>
                    <li style="margin-bottom: 10px; color: #666;"><i class="fas fa-check" style="color: #3b82f6; margin-right: 10px;"></i> Files remain on your device</li>
                    <li style="margin-bottom: 10px; color: #666;"><i class="fas fa-check" style="color: #3b82f6; margin-right: 10px;"></i> Automatic memory clearance</li>
                </ul>
            </div>
        </div>
    </div>
</section>
