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
        <div class="upload-icon-modern">
            <img src="pan-resizer-theme/assets/images/upload-icon.png" alt="Upload icon" width="100" height="100" style="border-radius: 20px; display: block;">
        </div>
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
