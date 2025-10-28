// Immediately start loading critical resources
document.addEventListener('DOMContentLoaded', function() {
  // Mark the LCP element when it's loaded
  const lcpElement = document.querySelector('.resizer-card h1');
  if (lcpElement) {
    lcpElement.setAttribute('elementtiming', 'LCP-element');
    lcpElement.style.fontDisplay = 'swap';
  }
  
  // Load non-critical resources later
  if ('requestIdleCallback' in window) {
    requestIdleCallback(function() {
      loadNonCriticalResources();
    });
  } else {
    setTimeout(loadNonCriticalResources, 200);
  }
});

function loadNonCriticalResources() {
  // Load Font Awesome asynchronously
  const fontAwesome = document.createElement('link');
  fontAwesome.rel = 'stylesheet';
  fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css';
  document.head.appendChild(fontAwesome);
}

// Initialize UI components
document.addEventListener('DOMContentLoaded', function() {
  window.addEventListener('scroll', function() {}, {passive: true});
  window.addEventListener('touchstart', function() {}, {passive: true});
  window.addEventListener('touchmove', function() {}, {passive: true});
  

  // FAQ functionality
  const faqItems = document.querySelectorAll('.faq-item');
  if (faqItems.length > 0) {
    faqItems.forEach((item, index) => {
      const question = item.querySelector('.faq-question');
      const answer = item.querySelector('.faq-answer');

      if (question && answer) {
        // Generate unique IDs for accessibility
        const questionId = `faq-question-${index}`;
        const answerId = `faq-answer-${index}`;

        // Add tabindex and role for accessibility
        question.setAttribute('tabindex', '0');
        question.setAttribute('role', 'button');
        question.setAttribute('aria-expanded', 'false');
        question.setAttribute('id', questionId);
        question.setAttribute('aria-controls', answerId);

        answer.setAttribute('aria-hidden', 'true');
        answer.setAttribute('id', answerId);
        answer.setAttribute('role', 'region');
        answer.setAttribute('aria-labelledby', questionId);

        // Click event handler
        question.addEventListener('click', () => {
          toggleFaqItem(item, question, answer);
        });

        // Keyboard support
        question.addEventListener('keydown', (e) => {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            toggleFaqItem(item, question, answer);
          }
        });
      }
    });
  }

  // Helper function to toggle FAQ items
  function toggleFaqItem(item, question, answer) {
    const isActive = item.classList.contains('active');

    // Close all other items
    faqItems.forEach(otherItem => {
      const otherQuestion = otherItem.querySelector('.faq-question');
      const otherAnswer = otherItem.querySelector('.faq-answer');
      otherItem.classList.remove('active');
      if (otherQuestion) otherQuestion.setAttribute('aria-expanded', 'false');
      if (otherAnswer) {
        otherAnswer.setAttribute('aria-hidden', 'true');
        // Adjust max-height to ensure proper animation and accessibility
        otherAnswer.style.maxHeight = '0';
      }
    });

    // Toggle current item
    if (!isActive) {
      item.classList.add('active');
      question.setAttribute('aria-expanded', 'true');
      answer.setAttribute('aria-hidden', 'false');
      // Use a large max-height to ensure all content is visible
      answer.style.maxHeight = '1000px';
    }
  }
});


document.addEventListener('DOMContentLoaded', function() {
  // Elements - Step 1
  const step1Container = document.getElementById('step1Container');
  const dropZone = document.getElementById('dropZone');
  const fileInput = document.getElementById('fileInput');
  const chooseFileBtn = document.getElementById('chooseFileBtn');
  const filePreview = document.getElementById('filePreview');
  const resetBtn = document.getElementById('resetBtn');
  const nextBtn = document.getElementById('nextBtn');
  const menuToggle = document.getElementById('menuToggle');
  const shareButton = document.getElementById('shareButton');

  // Elements - Step 2
  const step2Container = document.getElementById('step2Container');
  const backBtn = document.getElementById('backBtn');
  const step2NextBtn = document.getElementById('step2NextBtn');
  const docTypeOptions = document.getElementsByName('docType');

  // Elements - Step 3 Photo Editor
  const photoEditorContainer = document.getElementById('photoEditorContainer');
  const photoCanvasContainer = document.getElementById('photoCanvasContainer');
  const photoBackBtn = document.getElementById('photoBackBtn');

  // Elements - Step 3 Signature Editor
  const signatureEditorContainer = document.getElementById('signatureEditorContainer');
  const signatureCanvasContainer = document.getElementById('signatureCanvasContainer');
  const signatureBackBtn = document.getElementById('signatureBackBtn');

  // Elements - Step 3 Document Editor
  const documentEditorContainer = document.getElementById('documentEditorContainer');
  const documentCanvasContainer = document.getElementById('documentCanvasContainer');
  const documentBrightnessSlider = document.getElementById('documentBrightnessSlider');
  const documentContrastSlider = document.getElementById('documentContrastSlider');
  const documentResetBtn = document.getElementById('documentResetBtn');
  const documentDownloadBtn = document.getElementById('documentDownloadBtn');
  const documentBackBtn = document.getElementById('documentBackBtn');
  const cropOverlay = document.getElementById('cropOverlay');

  // File storage
  let currentFile = null;
  let selectedDocType = 'photo';

  // Canvas elements
  let photoCanvas, photoCtx, signatureCanvas, signatureCtx, documentCanvas, documentCtx;

  // Images
  let originalImage = new Image();

  // Editor states
  const photoState = {
    rotation: 0,
    zoom: 100,
    brightness: 100,
    contrast: 100,
    offsetX: 0,
    offsetY: 0,
    dragging: false,
    lastX: 0,
    lastY: 0
  };

  const signatureState = {
    rotation: 0,
    zoom: 100,
    brightness: 100,
    contrast: 100,
    offsetX: 0,
    offsetY: 0,
    dragging: false,
    lastX: 0,
    lastY: 0
  };

  const documentState = {
    brightness: 100,
    contrast: 100,
    cropX: 50,
    cropY: 50,
    cropWidth: 200,
    cropHeight: 200,
    cropDragging: false,
    cropResizing: false,
    cropHandle: null,
    lastX: 0,
    lastY: 0
  };

  // Toggle menu functionality (for mobile)
  const mobileMenu = document.getElementById('mobileMenu');
  menuToggle.addEventListener('click', function(e) {
    e.stopPropagation();
    const isExpanded = mobileMenu.classList.contains('active');
    mobileMenu.classList.toggle('active');
    menuToggle.setAttribute('aria-expanded', !isExpanded);
  });

  // Share button functionality
  if (shareButton) {
    shareButton.addEventListener('click', async function() {
      const shareData = {
        title: 'PAN Card Photo Resizer - Free Online Tool',
        text: 'Check out this free online PAN Card photo resizer tool! Resize photos, signatures, and documents for NSDL/UTI applications.',
        url: window.location.href
      };

      try {
        // Check if Web Share API is supported
        if (navigator.share) {
          await navigator.share(shareData);
        } else {
          // Fallback: Copy link to clipboard
          await navigator.clipboard.writeText(window.location.href);
          
          // Show a temporary notification
          const originalIcon = shareButton.innerHTML;
          shareButton.innerHTML = '<i class="fas fa-check"></i>';
          shareButton.style.color = '#4caf50';
          
          setTimeout(() => {
            shareButton.innerHTML = originalIcon;
            shareButton.style.color = 'white';
          }, 2000);
          
          // Optional: You can also add a toast notification here
          alert('Link copied to clipboard!');
        }
      } catch (err) {
        // User cancelled or error occurred
        if (err.name !== 'AbortError') {
          console.error('Error sharing:', err);
        }
      }
    });
  }

  // Close menu when clicking outside
  document.addEventListener('click', function(e) {
    if (!mobileMenu.contains(e.target) && !menuToggle.contains(e.target)) {
      mobileMenu.classList.remove('active');
    }
  });

  // Step 1: File Upload
  chooseFileBtn.addEventListener('click', function(e) {
    e.stopPropagation(); // Prevent event from bubbling to dropZone
    fileInput.click();
  });

  // Handle file selection
  fileInput.addEventListener('change', async function() {
    if (fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const maxSize = 10 * 1024 * 1024; // 10MB in bytes

      if (file.size > maxSize) {
        const errorMsg = document.createElement('div');
        errorMsg.className = 'error-message';
        errorMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> File size must be less than 10MB';
        dropZone.appendChild(errorMsg);
        setTimeout(() => errorMsg.remove(), 3000);
        fileInput.value = '';
        return;
      }

      const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
      if (!validTypes.includes(file.type)) {
        alert('Please select a valid file type (JPG, PNG, or PDF)');
        fileInput.value = '';
        return;
      }

      if (file.type === 'application/pdf') {
        await handlePdfFile(file);
      } else {
        handleFiles(fileInput.files);
      }
    }
  });

  // Handle PDF conversion
  async function handlePdfFile(file) {
    try {
      const fileReader = new FileReader();
      fileReader.onload = async function() {
        const typedarray = new Uint8Array(this.result);

        const loadingTask = pdfjsLib.getDocument(typedarray);
        const pdf = await loadingTask.promise;
        const page = await pdf.getPage(1); // Get first page (1-based index)

        const viewport = page.getViewport({ scale: 2.0 }); // Increased scale for better quality
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        canvas.height = viewport.height;
        canvas.width = viewport.width;

        await page.render({
          canvasContext: context,
          viewport: viewport
        }).promise;

        canvas.toBlob((blob) => {
          const convertedFile = new File([blob], 'converted.png', { type: 'image/png' });
          handleFiles([convertedFile]);
        }, 'image/png', 1.0);
      };

      fileReader.readAsArrayBuffer(file);
    } catch (error) {
      console.error('Error converting PDF:', error);
      alert('Error converting PDF. Please try again.');
    }
  }

  // Handle drag and drop
  dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    dropZone.classList.add('dragover');
  });

  dropZone.addEventListener('dragleave', function() {
    dropZone.classList.remove('dragover');
  });

  dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    dropZone.classList.remove('dragover');

    if (e.dataTransfer.files.length > 0) {
      handleFiles(e.dataTransfer.files);
    }
  });

  // Also allow clicking on the entire drop zone
  dropZone.addEventListener('click', function() {
    fileInput.click();
  });

  // Reset button functionality
  resetBtn.addEventListener('click', function() {
    resetUpload();
  });

  // Next button functionality for Step 1
  nextBtn.addEventListener('click', function() {
    // Only proceed if we have a file
    if (currentFile) {
      showStep2();
    } else {
      alert('Please upload a file before proceeding to the next step.');
    }
  });

  // Step 2: Back button functionality
  backBtn.addEventListener('click', function() {
    showStep1();
  });

  // Step 2: Next button functionality
  step2NextBtn.addEventListener('click', function() {
    // Verify we have a file
    if (!currentFile) {
      alert('Please upload a file before proceeding.');
      showStep1();
      return;
    }

    // Get selected document type
    selectedDocType = getSelectedDocType();

    // Show the appropriate editor
    if (selectedDocType === 'photo') {
      showPhotoEditor();
    } else if (selectedDocType === 'signature') {
      showSignatureEditor();
    } else if (selectedDocType === 'document') {
      showDocumentEditor();
    }
  });

  // Photo Editor Back Button
  photoBackBtn.addEventListener('click', function() {
    showStep2();
  });

  // Photo Editor Preview Button
  document.getElementById('photoPreviewBtn').addEventListener('click', function() {
    showImagePreview('photo');
  });

  // Signature Editor Back Button
  signatureBackBtn.addEventListener('click', function() {
    showStep2();
  });

  // Signature Editor Preview Button
  document.getElementById('signaturePreviewBtn').addEventListener('click', function() {
    showImagePreview('signature');
  });

  // Document Editor Back Button
  const documentBackBtns = document.querySelectorAll('#documentBackBtn');
  documentBackBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      showStep2();
    });
  });

  // Document Editor Preview Button
  const documentPreviewBtns = document.querySelectorAll('#documentPreviewBtn');
  documentPreviewBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const cropOverlay = document.getElementById('cropOverlay');
      if (!cropOverlay) return;

      // Calculate the crop dimensions
      const overlayRect = cropOverlay.getBoundingClientRect();
      const documentRect = documentCanvas.getBoundingClientRect();

      // Calculate the scale ratio between displayed image and actual canvas
      const scaleX = documentCanvas.width / documentRect.width;
      const scaleY = documentCanvas.height / documentRect.height;

      // Calculate the actual crop coordinates on the original canvas
      const cropX = (overlayRect.left - documentRect.left) * scaleX;
      const cropY = (overlayRect.top - documentRect.top) * scaleY;
      const cropWidth = overlayRect.width * scaleX;
      const cropHeight = overlayRect.height * scaleY;

      // Create temp canvas for the preview
      const tempCanvas = document.createElement('canvas');
      tempCanvas.width = cropWidth;
      tempCanvas.height = cropHeight;
      const tempCtx = tempCanvas.getContext('2d');

      // Apply current brightness and contrast filters
      tempCtx.filter = `brightness(${documentState.brightness}%) contrast(${documentState.contrast}%)`;
      tempCtx.drawImage(
        documentCanvas,
        cropX, cropY, cropWidth, cropHeight,
        0, 0, tempCanvas.width, tempCanvas.height
      );

      // Show preview with processed image
      showImagePreview('document', tempCanvas);
    });
  });

  // Control events are set up in the setupPhotoEditorSymbols() and setupSignatureEditorSymbols() functions
  // No need to duplicate event listeners here

  // Document Editor event listeners will be set up in setupDocumentEditorSymbols()

  // Function to handle the selected files
  function handleFiles(files) {
    // For now, we'll just handle the first file
    const file = files[0];
    currentFile = file;

    // Check if the file is an image or PDF
    if (file.type.match('image.*') || file.type === 'application/pdf') {
      // Show the file preview section
      dropZone.style.display = 'none';
      filePreview.style.display = 'block';

      // Enable the next button
      nextBtn.disabled = false;

      // Load the image for later use
      if (file.type.match('image.*')) {
        originalImage = new Image();
        const reader = new FileReader();

        reader.onload = function(e) {
          originalImage.src = e.target.result;
        };

        reader.readAsDataURL(file);
      }

      // Create a preview of the file
      createFilePreview(file);
    } else {
      alert('Please select an image (JPG, PNG) or PDF file.');
    }
  }

  // Function to create a preview of the selected file
  function createFilePreview(file) {
    filePreview.innerHTML = '';

    const fileItem = document.createElement('div');
    fileItem.className = 'file-item';

    // Create image preview if it's an image
    if (file.type.match('image.*')) {
      const img = document.createElement('img');
      img.className = 'file-image';

      const reader = new FileReader();
      reader.onload = function(e) {
        img.src = e.target.result;

        // Get image dimensions once loaded
        img.onload = function() {
          const dimensions = img.naturalWidth + 'x' + img.naturalHeight;
          updateFileInfo(fileItem, file.name, formatBytes(file.size), dimensions);
        };
      };
      reader.readAsDataURL(file);

      fileItem.appendChild(img);
    } else if (file.type === 'application/pdf') {
      // For PDF, just show a placeholder or icon
      const pdfPlaceholder = document.createElement('div');
      pdfPlaceholder.className = 'pdf-placeholder';
      pdfPlaceholder.innerHTML = '<i class="fas fa-file-pdf" style="font-size: 48px; color: #ef4444; margin: 20px;"></i>';
      fileItem.appendChild(pdfPlaceholder);

      updateFileInfo(fileItem, file.name, formatBytes(file.size), 'PDF Document');
    }

    filePreview.appendChild(fileItem);
  }

  // Function to update file information
  function updateFileInfo(fileItem, name, size, dimensions) {
    const fileInfo = document.createElement('div');
    fileInfo.className = 'file-info';

    const fileDetails = document.createElement('div');
    fileDetails.className = 'file-details';

    const fileDimensions = document.createElement('div');
    fileDimensions.className = 'file-dimensions';
    fileDimensions.textContent = dimensions;

    const fileSize = document.createElement('div');
    fileSize.className = 'file-size';
    fileSize.textContent = size;

    fileDetails.appendChild(fileDimensions);
    fileDetails.appendChild(fileSize);

    const deleteBtn = document.createElement('button');
    deleteBtn.className = 'delete-btn';
    deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
    deleteBtn.addEventListener('click', function(e) {
      e.stopPropagation(); // Prevent event from bubbling
      resetUpload();
    });

    fileInfo.appendChild(fileDetails);
    fileInfo.appendChild(deleteBtn);

    fileItem.appendChild(fileInfo);
  }

  // Format bytes to human-readable format
  function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
  }

  // Reset the upload form
  function resetUpload() {
    fileInput.value = '';
    filePreview.style.display = 'none';
    dropZone.style.display = 'block';
    filePreview.innerHTML = '';
    nextBtn.disabled = true;
    currentFile = null;
  }

  // Get selected document type
  function getSelectedDocType() {
    for (let i = 0; i < docTypeOptions.length; i++) {
      if (docTypeOptions[i].checked) {
        return docTypeOptions[i].value;
      }
    }
    return 'photo'; // Default to photo
  }

  // Show Step 1 and hide others
  function showStep1() {
    step1Container.style.display = 'block';
    step2Container.style.display = 'none';
    photoEditorContainer.style.display = 'none';
    signatureEditorContainer.style.display = 'none';
    documentEditorContainer.style.display = 'none';
  }

  // Show Step 2 and hide others
  function showStep2() {
    step1Container.style.display = 'none';
    step2Container.style.display = 'block';
    photoEditorContainer.style.display = 'none';
    signatureEditorContainer.style.display = 'none';
    documentEditorContainer.style.display = 'none';
  }

  // Show Photo Editor
  function showPhotoEditor() {
    step1Container.style.display = 'none';
    step2Container.style.display = 'none';
    photoEditorContainer.style.display = 'block';
    signatureEditorContainer.style.display = 'none';
    documentEditorContainer.style.display = 'none';

    // Initialize the photo canvas if not already created
    initPhotoCanvas();

    // Setup editing symbols for photo editor
    setupPhotoEditorSymbols();
  }

  // Setup Photo Editor Symbols
  function setupPhotoEditorSymbols() {
    // Create the symbols container if it doesn't exist
    if (!document.getElementById('photoEditingSymbols')) {
      const symbolsContainer = document.createElement('div');
      symbolsContainer.id = 'photoEditingSymbols';
      symbolsContainer.className = 'editing-symbols';

      // Create symbols
      const symbols = [
        { id: 'photoRotateSymbol', icon: 'fa-rotate', title: 'Rotate' },
        { id: 'photoZoomSymbol', icon: 'fa-search-plus', title: 'Zoom' },
        { id: 'photoAdjustSymbol', icon: 'fa-sliders', title: 'Adjust' },
        { id: 'photoResetSymbol', icon: 'fa-undo', title: 'Reset' },
        { id: 'photoDownloadSymbol', icon: 'fa-download', title: 'Download' }
      ];

      // Add symbols to container
      symbols.forEach(symbol => {
        const symbolElement = document.createElement('div');
        symbolElement.id = symbol.id;
        symbolElement.className = 'edit-symbol';
        symbolElement.title = symbol.title;
        symbolElement.innerHTML = `<i class="fas ${symbol.icon}"></i>`;
        symbolsContainer.appendChild(symbolElement);
      });

      // Create panels container
      const panelsContainer = document.createElement('div');
      panelsContainer.id = 'photoEditingPanels';

      // Create rotate panel
      const rotatePanel = document.createElement('div');
      rotatePanel.id = 'photoRotatePanel';
      rotatePanel.className = 'editor-panel';
      rotatePanel.innerHTML = `
        <div class="control-group">
          <button class="control-btn" id="photoRotateLeftBtn">
            <i class="fas fa-undo"></i> Rotate Left
          </button>
          <button class="control-btn" id="photoRotateRightBtn">
            <i class="fas fa-redo"></i> Rotate Right
          </button>
          <div class="control-group">
            <label class="control-label">Precise Rotation:</label>
            <input type="range" class="control-slider" id="photoRotationSlider" min="0" max="359" value="0">
            <span id="photoRotationValue" class="slider-value">0°</span>
          </div>
        </div>
      `;

      // Create zoom panel
      const zoomPanel = document.createElement('div');
      zoomPanel.id = 'photoZoomPanel';
      zoomPanel.className = 'editor-panel';
      zoomPanel.innerHTML = `
        <div class="control-group">
          <label class="control-label">Zoom:</label>
          <input type="range" class="control-slider" id="photoZoomSlider" min="50" max="400" value="100">
        </div>
      `;

      // Create combined brightness/contrast panel
      const adjustPanel = document.createElement('div');
      adjustPanel.id = 'photoAdjustPanel';
      adjustPanel.className = 'editor-panel';
      adjustPanel.innerHTML = `
        <div class="control-group">
          <label class="control-label">Brightness:</label>
          <input type="range" class="control-slider" id="photoBrightnessSlider" min="0" max="200" value="100">
        </div>
        <div class="control-group">
          <label class="control-label">Contrast:</label>
          <input type="range" class="control-slider" id="photoContrastSlider" min="0" max="200" value="100">
        </div>
      `;

      // Add panels to container
      panelsContainer.appendChild(rotatePanel);
      panelsContainer.appendChild(zoomPanel);
      panelsContainer.appendChild(adjustPanel);

      // Replace the editor controls with symbols and panels
      const editorControls = document.querySelector('#photoEditorContainer .editor-controls');
      if (editorControls) {
        editorControls.parentNode.removeChild(editorControls);
      }

      // Insert the symbols and panels after the image container
      const imageContainer = document.querySelector('#photoEditorContainer .image-container');
      if (imageContainer) {
        imageContainer.insertAdjacentElement('afterend', symbolsContainer);
        symbolsContainer.insertAdjacentElement('afterend', panelsContainer);
      }

      // Add event listeners to symbols
      document.getElementById('photoRotateSymbol').addEventListener('click', function() {
        togglePanel('photoRotatePanel');
      });

      document.getElementById('photoZoomSymbol').addEventListener('click', function() {
        togglePanel('photoZoomPanel');
      });

      document.getElementById('photoAdjustSymbol').addEventListener('click', function() {
        togglePanel('photoAdjustPanel');
      });

      document.getElementById('photoResetSymbol').addEventListener('click', function() {
        resetPhotoEditor();
      });

      document.getElementById('photoDownloadSymbol').addEventListener('click', function() {
        downloadPhoto();
      });



      // Assign event listeners for control buttons if they exist
      const photoRotateLeftBtn = document.getElementById('photoRotateLeftBtn');
      if (photoRotateLeftBtn) {
        photoRotateLeftBtn.addEventListener('click', function() {
          photoState.rotation = (photoState.rotation - 90) % 360;
          renderPhotoCanvas();
        });
      }

      const photoRotateRightBtn = document.getElementById('photoRotateRightBtn');
      if (photoRotateRightBtn) {
        photoRotateRightBtn.addEventListener('click', function() {
          photoState.rotation = (photoState.rotation + 90) % 360;
          document.getElementById('photoRotationSlider').value = photoState.rotation;
          document.getElementById('photoRotationValue').textContent = photoState.rotation + '°';
          renderPhotoCanvas();
        });
      }

      const photoRotationSlider = document.getElementById('photoRotationSlider');
      if (photoRotationSlider) {
        photoRotationSlider.addEventListener('input', function() {
          photoState.rotation = parseInt(this.value);
          document.getElementById('photoRotationValue').textContent = photoState.rotation + '°';
          renderPhotoCanvas();
        });
      }

      const photoZoomSlider = document.getElementById('photoZoomSlider');
      if (photoZoomSlider) {
        photoZoomSlider.addEventListener('input', function() {
          photoState.zoom = parseInt(this.value);
          renderPhotoCanvas();
          updatePhotoZoomValue();
        });
      }

      const photoBrightnessSlider = document.getElementById('photoBrightnessSlider');
      if (photoBrightnessSlider) {
        photoBrightnessSlider.addEventListener('input', function() {
          photoState.brightness = parseInt(this.value);
          renderPhotoCanvas();
        });
      }

      const photoContrastSlider = document.getElementById('photoContrastSlider');
      if (photoContrastSlider) {
        photoContrastSlider.addEventListener('input', function() {
          photoState.contrast = parseInt(this.value);
          renderPhotoCanvas();
        });
      }
    }
  }

  // Toggle editor panel
  function togglePanel(panelId) {
    // Get all panels
    const panels = document.querySelectorAll('.editor-panel');

    // Hide all panels first
    panels.forEach(panel => {
      panel.classList.remove('active');
    });

    // Show the selected panel
    const selectedPanel = document.getElementById(panelId);
    if (selectedPanel) {
      selectedPanel.classList.toggle('active');
    }
  }

  // Show Signature Editor
  function showSignatureEditor() {
    step1Container.style.display = 'none';
    step2Container.style.display = 'none';
    photoEditorContainer.style.display = 'none';
    signatureEditorContainer.style.display = 'block';
    documentEditorContainer.style.display = 'none';

    // Initialize the signature canvas if not already created
    initSignatureCanvas();

    // Setup editing symbols for signature editor
    setupSignatureEditorSymbols();
  }

  // Setup Signature Editor Symbols
  function setupSignatureEditorSymbols() {
    // Create the symbols container if it doesn't exist
    if (!document.getElementById('signatureEditingSymbols')) {
      const symbolsContainer = document.createElement('div');
      symbolsContainer.id = 'signatureEditingSymbols';
      symbolsContainer.className = 'editing-symbols';

      // Create symbols
      const symbols = [
        { id: 'signatureRotateSymbol', icon: 'fa-rotate', title: 'Rotate' },
        { id: 'signatureZoomSymbol', icon: 'fa-search-plus', title: 'Zoom' },
        { id: 'signatureAdjustSymbol', icon: 'fa-sliders', title: 'Adjust' },
        { id: 'signatureResetSymbol', icon: 'fa-undo', title: 'Reset' },
        { id: 'signatureDownloadSymbol', icon: 'fa-download', title: 'Download' }
      ];

      // Add symbols to container
      symbols.forEach(symbol => {
        const symbolElement = document.createElement('div');
        symbolElement.id = symbol.id;
        symbolElement.className = 'edit-symbol';
        symbolElement.title = symbol.title;
        symbolElement.innerHTML = `<i class="fas ${symbol.icon}"></i>`;
        symbolsContainer.appendChild(symbolElement);
      });

      // Create panels container
      const panelsContainer = document.createElement('div');
      panelsContainer.id = 'signatureEditingPanels';

      // Create rotate panel
      const rotatePanel = document.createElement('div');
      rotatePanel.id = 'signatureRotatePanel';
      rotatePanel.className = 'editor-panel';
      rotatePanel.innerHTML = `
        <div class="control-group">
          <button class="control-btn" id="signatureRotateLeftBtn">
            <i class="fas fa-undo"></i> Rotate Left
          </button>
          <button class="control-btn" id="signatureRotateRightBtn">
            <i class="fas fa-redo"></i> Rotate Right
          </button>
          <div class="control-group">
            <label class="control-label">Precise Rotation:</label>
            <input type="range" class="control-slider" id="signatureRotationSlider" min="0" max="359" value="0">
            <span id="signatureRotationValue" class="slider-value">0°</span>
          </div>
        </div>
      `;

      // Create zoom panel
      const zoomPanel = document.createElement('div');
      zoomPanel.id = 'signatureZoomPanel';
      zoomPanel.className = 'editor-panel';
      zoomPanel.innerHTML = `
        <div class="control-group">
          <label class="control-label">Zoom:</label>
          <input type="range" class="control-slider" id="signatureZoomSlider" min="20" max="800" value="100">
          <span id="signatureZoomValue" class="slider-value">100%</span>
        </div>
      `;

      // Create combined brightness/contrast panel
      const adjustPanel = document.createElement('div');
      adjustPanel.id = 'signatureAdjustPanel';
      adjustPanel.className = 'editor-panel';
      adjustPanel.innerHTML = `
        <div class="control-group">
          <label class="control-label">Brightness:</label>
          <input type="range" class="control-slider" id="signatureBrightnessSlider" min="0" max="200" value="100">
        </div>
        <div class="control-group">
          <label class="control-label">Contrast:</label>
          <input type="range" class="control-slider" id="signatureContrastSlider" min="0" max="200" value="100">
        </div>
      `;

      // Add panels to container
      panelsContainer.appendChild(rotatePanel);
      panelsContainer.appendChild(zoomPanel);
      panelsContainer.appendChild(adjustPanel);

      // Replace the editor controls with symbols and panels
      const editorControls = document.querySelector('#signatureEditorContainer .editor-controls');
      if (editorControls) {
        editorControls.parentNode.removeChild(editorControls);
      }

      // Insert the symbols and panels after the image container
      const imageContainer = document.querySelector('#signatureEditorContainer .image-container');
      if (imageContainer) {
        imageContainer.insertAdjacentElement('afterend', symbolsContainer);
        symbolsContainer.insertAdjacentElement('afterend', panelsContainer);
      }

      // Add event listeners to symbols
      document.getElementById('signatureRotateSymbol').addEventListener('click', function() {
        togglePanel('signatureRotatePanel');
      });

      document.getElementById('signatureZoomSymbol').addEventListener('click', function() {
        togglePanel('signatureZoomPanel');
      });

      document.getElementById('signatureAdjustSymbol').addEventListener('click', function() {
        togglePanel('signatureAdjustPanel');
      });

      document.getElementById('signatureResetSymbol').addEventListener('click', function() {
        resetSignatureEditor();
      });

      document.getElementById('signatureDownloadSymbol').addEventListener('click', function() {
        downloadSignature();
      });



      // Assign event listeners for control buttons if they exist
      const signatureRotateLeftBtn = document.getElementById('signatureRotateLeftBtn');
      if (signatureRotateLeftBtn) {
        signatureRotateLeftBtn.addEventListener('click', function() {
          signatureState.rotation = (signatureState.rotation - 90) % 360;
          renderSignatureCanvas();
        });
      }

      const signatureRotateRightBtn = document.getElementById('signatureRotateRightBtn');
      if (signatureRotateRightBtn) {
        signatureRotateRightBtn.addEventListener('click', function() {
          signatureState.rotation = (signatureState.rotation + 90) % 360;
          document.getElementById('signatureRotationSlider').value = signatureState.rotation;
          document.getElementById('signatureRotationValue').textContent = signatureState.rotation + '°';
          renderSignatureCanvas();
        });
      }

      const signatureRotationSlider = document.getElementById('signatureRotationSlider');
      if (signatureRotationSlider) {
        signatureRotationSlider.addEventListener('input', function() {
          signatureState.rotation = parseInt(this.value);
          document.getElementById('signatureRotationValue').textContent = signatureState.rotation + '°';
          renderSignatureCanvas();
        });
      }

      const signatureZoomSlider = document.getElementById('signatureZoomSlider');
      if (signatureZoomSlider) {
        signatureZoomSlider.addEventListener('input', function() {
          signatureState.zoom = parseInt(this.value);
          renderSignatureCanvas();
          updateSignatureZoomValue();
        });
      }

      const signatureBrightnessSlider = document.getElementById('signatureBrightnessSlider');
      if (signatureBrightnessSlider) {
        signatureBrightnessSlider.addEventListener('input', function() {
          signatureState.brightness = parseInt(this.value);
          renderSignatureCanvas();        });
      }

      const signatureContrastSlider = document.getElementById('signatureContrastSlider');
      if (signatureContrastSlider) {
        signatureContrastSlider.addEventListener('input', function() {
          signatureState.contrast = parseInt(this.value);
          renderSignatureCanvas();
        });
      }
    }
  }

  // Show Document Editor
  function showDocumentEditor() {
    step1Container.style.display = 'none';
    step2Container.style.display = 'none';
    photoEditorContainer.style.display = 'none';
    signatureEditorContainer.style.display = 'none';
    documentEditorContainer.style.display = 'block';

    // Initialize the document canvas if not already created
    initDocumentCanvas();

    // Setup editing symbols for document editor
    setupDocumentEditorSymbols();

    // Setup initial document state
    documentState.brightness = 100;
    documentState.contrast = 100;
    documentState.zoom = 100;
    documentState.rotation = 0;

    // Render initial state
    renderDocumentCanvas();
  }

  // Setup Document Editor Symbols
  function setupDocumentEditorSymbols() {
    // Create the symbols container if it doesn't exist
    if (!document.getElementById('documentEditingSymbols')) {
      const symbolsContainer = document.createElement('div');
      symbolsContainer.id = 'documentEditingSymbols';
      symbolsContainer.className = 'editing-symbols';

      // Create symbols
      const symbols = [
        { id: 'documentCropSymbol', icon: 'fa-crop', title: 'Crop' },
        { id: 'documentAdjustSymbol', icon: 'fa-sliders', title: 'Adjust' },
        { id: 'documentResetSymbol', icon: 'fa-undo', title: 'Reset' },
        { id: 'documentDownloadSymbol', icon: 'fa-download', title: 'Download' }
      ];

      // Add symbols to container
      symbols.forEach(symbol => {
        const symbolElement = document.createElement('div');
        symbolElement.id = symbol.id;
        symbolElement.className = 'edit-symbol';
        symbolElement.title = symbol.title;
        symbolElement.innerHTML = `<i class="fas ${symbol.icon}"></i>`;
        symbolsContainer.appendChild(symbolElement);
      });

      // Create panels container
      const panelsContainer = document.createElement('div');
      panelsContainer.id = 'documentEditingPanels';

      // Create crop panel
      const cropPanel = document.createElement('div');
      cropPanel.id = 'documentCropPanel';
      cropPanel.className = 'editor-panel';
      cropPanel.innerHTML = `
    <div class="control-group">
      <p class="crop-info">Drag the crop area or its handles to adjust. The download will only include the selected area.</p>
      <p id="cropDimensionsInfo" class="crop-dimensions">Selected area: 0 × 0 px</p>
    </div>
    <div class="control-group">
      <button class="control-btn" id="cropResetBtn">
        <i class="fas fa-expand"></i> Reset to Full Image
      </button>
      <button class="control-btn" id="applyCropBtn">
        <i class="fas fa-crop"></i> Apply Crop
      </button>
    </div>
  `;

      // Create combined brightness/contrast panel
      const adjustPanel = document.createElement('div');
      adjustPanel.id = 'documentAdjustPanel';
      adjustPanel.className = 'editor-panel';
      adjustPanel.innerHTML = `
        <div class="control-group">
          <label class="control-label">Brightness:</label>
          <input type="range" class="control-slider" id="documentBrightnessSlider" min="0" max="200" value="100">
        </div>
        <div class="control-group">
          <label class="control-label">Contrast:</label>
          <input type="range" class="control-slider" id="documentContrastSlider" min="0" max="200" value="100">
        </div>
      `;

      // Add panels to container
      panelsContainer.appendChild(cropPanel);
      panelsContainer.appendChild(adjustPanel);

      // Replace the editor controls with symbols and panels
      const editorControls = document.querySelector('#documentEditorContainer .editor-controls');
      if (editorControls) {
        editorControls.parentNode.removeChild(editorControls);
      }

      // Insert the symbols and panels after the image container
      const imageContainer = document.querySelector('#documentEditorContainer .image-container');
      if (imageContainer) {
        imageContainer.insertAdjacentElement('afterend', symbolsContainer);
        symbolsContainer.insertAdjacentElement('afterend', panelsContainer);
      }

      // Add event listeners to symbols
      const documentCropSymbol = document.getElementById('documentCropSymbol');
      if (documentCropSymbol) {
        documentCropSymbol.addEventListener('click', function() {
          togglePanel('documentCropPanel');
        });
      }

      const documentAdjustSymbol = document.getElementById('documentAdjustSymbol');
      if (documentAdjustSymbol) {
        documentAdjustSymbol.addEventListener('click', function() {
          togglePanel('documentAdjustPanel');
        });
      }

      const documentResetSymbol = document.getElementById('documentResetSymbol');
      if (documentResetSymbol) {
        documentResetSymbol.addEventListener('click', function() {
          resetDocumentEditor();
        });
      }

      const documentDownloadSymbol = document.getElementById('documentDownloadSymbol');
      if (documentDownloadSymbol) {
        documentDownloadSymbol.addEventListener('click', function() {
          downloadDocument();
        });
      }

      // Add listener for crop reset button if it exists
      const cropResetBtn = document.getElementById('cropResetBtn');
      if (cropResetBtn) {
        cropResetBtn.addEventListener('click', function() {
          initCropAreaToFullImage();
          renderDocumentCanvas();
          showCropPreview();
        });
      }

      // Add listener for apply crop button
      const applyCropBtn = document.getElementById('applyCropBtn');
      if (applyCropBtn) {
        applyCropBtn.addEventListener('click', function() {
          applyCrop();
        });
      }

      // Function to apply the crop
      function applyCrop() {
        const cropOverlay = document.getElementById('cropOverlay');
        if (!cropOverlay) return;

        const overlayRect = cropOverlay.getBoundingClientRect();
        const documentRect = documentCanvas.getBoundingClientRect();

        // Calculate the scale ratio between displayed image and actual canvas
        const scaleX = documentCanvas.width / documentRect.width;
        const scaleY = documentCanvas.height / documentRect.height;

        // Calculate the actual position on the canvas based on visual position
        const cropX = (overlayRect.left - documentRect.left) * scaleX;
        const cropY = (overlayRect.top - documentRect.top) * scaleY;
        const cropWidth = overlayRect.width * scaleX;
        const cropHeight = overlayRect.height * scaleY;

        // Create a temporary canvas for the cropped image
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = cropWidth;
        tempCanvas.height = cropHeight;

        const tempCtx = tempCanvas.getContext('2d');
        tempCtx.drawImage(
          documentCanvas,
          cropX, cropY, cropWidth, cropHeight,
          0, 0, tempCanvas.width, tempCanvas.height
        );

        // Update the main canvas with the cropped image
        documentCanvas.width = cropWidth;
        documentCanvas.height = cropHeight;
        documentCtx.drawImage(tempCanvas, 0, 0);

        // Reset crop overlay to match new canvas size
        initCropAreaToFullImage();
        renderDocumentCanvas();
        showCropPreview();
      }

      // Add listener for crop preview button
      const cropPreviewBtn = document.getElementById('cropPreviewBtn');
      if (cropPreviewBtn) {
        cropPreviewBtn.addEventListener('click', showCropPreview);
      }

      // Reassign event listeners for control sliders if they exist
      const documentBrightnessSlider = document.getElementById('documentBrightnessSlider');
      if (documentBrightnessSlider) {
        documentBrightnessSlider.addEventListener('input', function() {
          documentState.brightness = parseInt(this.value);
          renderDocumentCanvas();
        });
      }

      const documentContrastSlider = document.getElementById('documentContrastSlider');
      if (documentContrastSlider) {
        documentContrastSlider.addEventListener('input', function() {
          documentState.contrast = parseInt(this.value);
          renderDocumentCanvas();
        });
      }
    }
  }

  // Initialize Photo Canvas
  function initPhotoCanvas() {
    // Create a canvas if it doesn't exist
    if (!photoCanvas) {
      photoCanvas = document.createElement('canvas');
      // Use higher resolution canvas for better quality
      photoCanvas.width = 800;
      photoCanvas.height = 800;
      photoCtx = photoCanvas.getContext('2d');
      photoCtx.imageSmoothingEnabled = true;
      photoCtx.imageSmoothingQuality = 'high';

      // Append the canvas to the container
      photoCanvasContainer.innerHTML = '';
      photoCanvasContainer.appendChild(photoCanvas);

      // Create photo overlay
      const photoOverlay = document.createElement('div');
      photoOverlay.className = 'photo-overlay';

      // Create bright center area
      const overlayArea = document.createElement('div');
      overlayArea.className = 'photo-overlay-area';

      photoOverlay.appendChild(overlayArea);
      photoCanvasContainer.appendChild(photoOverlay);



      // Add event listeners for dragging
      photoCanvas.addEventListener('mousedown', startPhotoDrag);
      photoCanvas.addEventListener('mousemove', movePhoto);
      photoCanvas.addEventListener('mouseup', endPhotoDrag);
      photoCanvas.addEventListener('mouseleave', endPhotoDrag);

      // Touch events for mobile
      photoCanvas.addEventListener('touchstart', startPhotoDragTouch);
      photoCanvas.addEventListener('touchmove', movePhotoTouch);
      photoCanvas.addEventListener('touchend', endPhotoDrag);

      // Mouse wheel for zooming - increased range
      photoCanvas.addEventListener('wheel', function(e) {
        e.preventDefault();
        if (e.deltaY < 0 && photoState.zoom < 400) {
          photoState.zoom += 5;
        } else if (e.deltaY > 0 && photoState.zoom > 50) {
          photoState.zoom -= 5;
        }
        photoZoomSlider.value = photoState.zoom;
        renderPhotoCanvas();
        updatePhotoZoomValue();
      });
    }

    // Reset editor state
    resetPhotoEditor();
  }

  function updatePhotoZoomValue() {
    const zoomValueElement = document.getElementById('photoZoomValue');
    if (zoomValueElement) {
      zoomValueElement.textContent = photoState.zoom + '%';
    }
  }

  function updateSignatureZoomValue() {
    const zoomValueElement = document.getElementById('signatureZoomValue');
    if (zoomValueElement) {
      zoomValueElement.textContent = signatureState.zoom + '%';
    }
  }

  // Initialize Signature Canvas
  function initSignatureCanvas() {
    // Create a canvas if it doesn't exist
    if (!signatureCanvas) {
      signatureCanvas = document.createElement('canvas');
      signatureCanvas.width = 1200;  // Higher resolution
      signatureCanvas.height = 1200; // Higher resolution
      signatureCtx = signatureCanvas.getContext('2d');
      signatureCtx.imageSmoothingEnabled = true;
      signatureCtx.imageSmoothingQuality = 'high';

      // Append the canvas to the container
      signatureCanvasContainer.innerHTML = '';
      signatureCanvasContainer.appendChild(signatureCanvas);

      // Create signature overlay
      const signatureOverlay = document.createElement('div');
      signatureOverlay.className = 'signature-overlay';

      // Create bright center area
      const overlayArea = document.createElement('div');
      overlayArea.className = 'signature-overlay-area';

      // Create top and bottom darker areas
      const overlayTop = document.createElement('div');
      overlayTop.className = 'signature-overlay-top';

      const overlayBottom = document.createElement('div');
      overlayBottom.className = 'signature-overlay-bottom';

      signatureOverlay.appendChild(overlayArea);
      signatureOverlay.appendChild(overlayTop);
      signatureOverlay.appendChild(overlayBottom);

      signatureCanvasContainer.appendChild(signatureOverlay);



      // Add event listeners for dragging
      signatureCanvas.addEventListener('mousedown', startSignatureDrag);
      signatureCanvas.addEventListener('mousemove', moveSignature);
      signatureCanvas.addEventListener('mouseup', endSignatureDrag);
      signatureCanvas.addEventListener('mouseleave', endSignatureDrag);

      // Touch events for mobile
      signatureCanvas.addEventListener('touchstart', startSignatureDragTouch);
      signatureCanvas.addEventListener('touchmove', moveSignatureTouch);
      signatureCanvas.addEventListener('touchend', endSignatureDrag);

      // Mouse wheel for zooming - increased range
      signatureCanvas.addEventListener('wheel', function(e) {
        e.preventDefault();
        if (e.deltaY < 0 && signatureState.zoom < 800) { // Increase max zoom
          signatureState.zoom += 10; // Faster zoom
        } else if (e.deltaY > 0 && signatureState.zoom > 20) { // Lower minimum zoom
          signatureState.zoom -= 10; // Faster zoom
        }
        signatureZoomSlider.value = signatureState.zoom;
        renderSignatureCanvas();
        updateSignatureZoomValue();
      });
    }

    // Reset editor state
    resetSignatureEditor();
  }

  // Initialize Document Canvas
  function initDocumentCanvas() {
    // Create a canvas if it doesn't exist
    if (!documentCanvas) {
      documentCanvas = document.createElement('canvas');
      // Use original image dimensions for best quality
      documentCanvas.width = originalImage.naturalWidth;
      documentCanvas.height = originalImage.naturalHeight;
      documentCtx = documentCanvas.getContext('2d');
      documentCtx.imageSmoothingEnabled = true;
      documentCtx.imageSmoothingQuality = 'high';

      // Append the canvas to the container
      documentCanvasContainer.innerHTML = '';
      documentCanvasContainer.appendChild(documentCanvas);

      // Remove existing crop overlay if any
      const existingOverlay = document.getElementById('cropOverlay');
      if (existingOverlay) {
        existingOverlay.remove();
      }

      // Create crop overlay
      const cropOverlay = document.createElement('div');
      cropOverlay.id = 'cropOverlay';
      cropOverlay.className = 'crop-overlay';

      // Add handles for resizing
      const handles = ['tl', 'tr', 'bl', 'br', 'tc', 'rc', 'bc', 'lc'];
      handles.forEach(position => {
        const handle = document.createElement('div');
        handle.className = `crop-handle ${position}`;
        cropOverlay.appendChild(handle);
      });

      documentCanvasContainer.appendChild(cropOverlay);

      // Add event listeners for crop overlay
      cropOverlay.addEventListener('mousedown', startCropDrag);
      document.addEventListener('mousemove', moveCrop);
      document.addEventListener('mouseup', endCropDrag);

      // Touch events
      cropOverlay.addEventListener('touchstart', startCropDragTouch);
      document.addEventListener('touchmove', moveCropTouch);
      document.addEventListener('touchend', endCropDrag);
    }

    // Reset editor state
    resetDocumentEditor();

    // Initialize crop area to cover the full image once it's loaded
    if (originalImage.complete) {
      initCropAreaToFullImage();
    } else {
      originalImage.onload = initCropAreaToFullImage;
    }
  }

  // Initialize crop area to cover the full image
  function initCropAreaToFullImage() {
    if (!originalImage.complete) return;

    const imageAspect = originalImage.width / originalImage.height;
    const containerAspect = documentCanvasContainer.clientWidth / documentCanvasContainer.clientHeight;

    let scale, drawWidth, drawHeight, offsetX, offsetY;

    if (imageAspect > containerAspect) {
      // Fit to width
      scale = documentCanvasContainer.clientWidth / originalImage.width;
      drawWidth = documentCanvasContainer.clientWidth;
      drawHeight = originalImage.height * scale;
      offsetX = 0;
      offsetY = (documentCanvasContainer.clientHeight - drawHeight) / 2;
    } else {
      // Fit to height
      scale = documentCanvasContainer.clientHeight / originalImage.height;
      drawHeight = documentCanvasContainer.clientHeight;
      drawWidth = originalImage.width * scale;
      offsetX = (documentCanvasContainer.clientWidth - drawWidth) / 2;
      offsetY = 0;
    }

    // Update canvas dimensions to match image
    documentCanvas.width = originalImage.width;
    documentCanvas.height = originalImage.height;

    // Set crop overlay to match the scaled image dimensions
    const cropOverlay = document.getElementById('cropOverlay');
    if (cropOverlay) {
      cropOverlay.style.left = offsetX + 'px';
      cropOverlay.style.top = offsetY + 'px';
      cropOverlay.style.width = drawWidth + 'px';
      cropOverlay.style.height = drawHeight + 'px';

      // Update crop state with actual dimensions
      documentState.cropX = offsetX;
      documentState.cropY = offsetY;
      documentState.cropWidth = drawWidth;
      documentState.cropHeight = drawHeight;
    }

    // Redraw canvas and update info
    renderDocumentCanvas();
    updateCropDimensionsInfo();
  }

  // Reset Photo Editor
  function resetPhotoEditor() {
    photoState.rotation = 0;
    photoState.zoom = 100;
    photoState.brightness = 100;
    photoState.contrast = 100;
    photoState.offsetX = 0;
    photoState.offsetY = 0;

    // Reset all sliders and values
    const photoRotationSlider = document.getElementById('photoRotationSlider');
    const photoRotationValue = document.getElementById('photoRotationValue');
    const photoZoomSlider = document.getElementById('photoZoomSlider');
    const photoBrightnessSlider = document.getElementById('photoBrightnessSlider');
    const photoContrastSlider = document.getElementById('photoContrastSlider');

    if (photoRotationSlider) photoRotationSlider.value = 0;
    if (photoRotationValue) photoRotationValue.textContent = '0°';
    if (photoZoomSlider) photoZoomSlider.value = 100;
    if (photoBrightnessSlider) photoBrightnessSlider.value = 100;
    if (photoContrastSlider) photoContrastSlider.value = 100;

    // Render the canvas
    renderPhotoCanvas();
    updatePhotoZoomValue();
  }

  // Reset Signature Editor
  function resetSignatureEditor() {
    signatureState.rotation = 0;
    signatureState.zoom = 100;
    signatureState.brightness = 100;
    signatureState.contrast = 100;
    signatureState.offsetX = 0;
    signatureState.offsetY = 0;

    // Reset all sliders and values
    const signatureRotationSlider = document.getElementById('signatureRotationSlider');
    const signatureRotationValue = document.getElementById('signatureRotationValue');
    const signatureZoomSlider = document.getElementById('signatureZoomSlider');
    const signatureBrightnessSlider = document.getElementById('signatureBrightnessSlider');
    const signatureContrastSlider = document.getElementById('signatureContrastSlider');

    if (signatureRotationSlider) signatureRotationSlider.value = 0;
    if (signatureRotationValue) signatureRotationValue.textContent = '0°';
    if (signatureZoomSlider) signatureZoomSlider.value = 100;
    if (signatureBrightnessSlider) signatureBrightnessSlider.value = 100;
    if (signatureContrastSlider) signatureContrastSlider.value = 100;

    // Render the canvas
    renderSignatureCanvas();
    updateSignatureZoomValue();
  }

  // Reset Document Editor
  function resetDocumentEditor() {
    documentState.brightness = 100;
    documentState.contrast = 100;

    // Reset all sliders
    const documentBrightnessSlider = document.getElementById('documentBrightnessSlider');
    const documentContrastSlider = document.getElementById('documentContrastSlider');

    if (documentBrightnessSlider) documentBrightnessSlider.value = 100;
    if (documentContrastSlider) documentContrastSlider.value = 100;

    // Reset crop area
    initCropAreaToFullImage();

    // Render the canvas
    renderDocumentCanvas();
  }

  // Render Photo Canvas
  function renderPhotoCanvas() {
    if (!originalImage.complete) {
      originalImage.onload = renderPhotoCanvas;
      return;
    }

    // Set high-quality rendering
    photoCtx.imageSmoothingEnabled = true;
    photoCtx.imageSmoothingQuality = 'high';

    // Clear the canvas
    photoCtx.clearRect(0, 0, photoCanvas.width, photoCanvas.height);

    // Save the current context state
    photoCtx.save();

    // Move to the center of the canvas
    photoCtx.translate(photoCanvas.width / 2, photoCanvas.height / 2);

    // Apply rotation
    photoCtx.rotate((photoState.rotation * Math.PI) / 180);

    // Apply zoom scale (based on user's zoom setting)
    const zoomScale = photoState.zoom / 100;

    // Calculate initial fitting scale (without the 0.8 reduction)
    const fitScale = Math.min(
      photoCanvas.width / originalImage.width,
      photoCanvas.height / originalImage.height
    ); // Use full canvas size

    // Apply combined scale
    const scale = fitScale * zoomScale;
    photoCtx.scale(scale, scale);

    // Apply offset
    photoCtx.translate(photoState.offsetX / scale, photoState.offsetY / scale);

    // Draw the image centered
    photoCtx.drawImage(
      originalImage,
      -originalImage.width / 2,
      -originalImage.height / 2,
      originalImage.width,
      originalImage.height
    );

    // Restore the context state
    photoCtx.restore();

    // Apply brightness and contrast
    applyBrightnessContrast(photoCanvas, photoCtx, photoState.brightness, photoState.contrast);
  }

  // Render Signature Canvas
  function renderSignatureCanvas() {
    if (!originalImage.complete) {
      originalImage.onload = renderSignatureCanvas;
      return;
    }

    // Set high-quality rendering
    signatureCtx.imageSmoothingEnabled = true;
    signatureCtx.imageSmoothingQuality = 'high';

    // Clear the canvas
    signatureCtx.clearRect(0, 0, signatureCanvas.width, signatureCanvas.height);

    // Save the current context state
    signatureCtx.save();

    // Move to the center of the canvas
    signatureCtx.translate(signatureCanvas.width / 2, signatureCanvas.height / 2);

    // Apply rotation
    signatureCtx.rotate((signatureState.rotation * Math.PI) / 180);

    // Apply zoom scale (based on user's zoom setting)
    const zoomScale = signatureState.zoom / 100;

    // Calculate initial fitting scale with better fitting algorithm
    let fitScale;
    const imgRatio = originalImage.width / originalImage.height;
    const canvasRatio = signatureCanvas.width / signatureCanvas.height;

    if (imgRatio > canvasRatio) {
      // Image is wider than canvas proportionally
      fitScale = signatureCanvas.width / originalImage.width;
    } else {
      // Image is taller than canvas proportionally
      fitScale = signatureCanvas.height / originalImage.height;
    }

    // Apply combined scale with more precise handling
    const scale = fitScale * zoomScale;
    signatureCtx.scale(scale, scale);

    // Apply offset without limitations
    signatureCtx.translate(signatureState.offsetX / scale, signatureState.offsetY / scale);

    // Draw the image centered - no dimensions limits
    signatureCtx.drawImage(
      originalImage,
      -originalImage.width / 2,
      -originalImage.height / 2,
      originalImage.width,
      originalImage.height
    );

    // Restore the context state
    signatureCtx.restore();

    // Apply brightness and contrast
    applyBrightnessContrast(signatureCanvas, signatureCtx, signatureState.brightness, signatureState.contrast);

    // Update zoom value display
    updateSignatureZoomValue();
  }

  // Render Document Canvas
  function renderDocumentCanvas() {
    if (!originalImage.complete) {
      originalImage.onload = renderDocumentCanvas;
      return;
    }

    // Clear the canvas
    documentCtx.clearRect(0, 0, documentCanvas.width, documentCanvas.height);

    // Create temporary canvas for filter effects
    const tempCanvas = document.createElement('canvas');
    tempCanvas.width = documentCanvas.width;
    tempCanvas.height = documentCanvas.height;
    const tempCtx = tempCanvas.getContext('2d');

    // Draw original image
    tempCtx.drawImage(originalImage, 0, 0, documentCanvas.width, documentCanvas.height);

    // Apply brightness and contrast
    const imageData = tempCtx.getImageData(0, 0, tempCanvas.width, tempCanvas.height);
    const brightness = (documentState.brightness - 100) * 1.5;
    const contrast = (documentState.contrast - 100) * 1.5;
    const factor = (259 * (contrast + 255)) / (255 * (259 - contrast));

    for (let i = 0; i < imageData.data.length; i += 4) {
      imageData.data[i] = truncate(factor * (imageData.data[i] - 128 + brightness) + 128);
      imageData.data[i + 1] = truncate(factor * (imageData.data[i + 1] - 128 + brightness) + 128);
      imageData.data[i + 2] = truncate(factor * (imageData.data[i + 2] - 128 + brightness) + 128);
    }

    tempCtx.putImageData(imageData, 0, 0);
    documentCtx.drawImage(tempCanvas, 0, 0);

    // Update crop preview if active
    if (document.getElementById('cropOverlay')) {
      showCropPreview();
    }
  }

  // Apply brightness and contrast to canvas
  function applyBrightnessContrast(canvas, ctx, brightness, contrast) {
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const data = imageData.data;

    brightness = (brightness - 100) * 1.5;  // Adjusted range
    contrast = (contrast - 100) * 1.5;     // Adjusted range

    const factor = (259 * (contrast + 255)) / (255 * (259 - contrast));

    for (let i = 0; i < data.length; i += 4) {
      // Apply brightness and contrast
      data[i] = truncate(factor * (data[i] - 128 + brightness) + 128);       // Red
      data[i + 1] = truncate(factor * (data[i + 1] - 128 + brightness) + 128); // Green
      data[i + 2] = truncate(factor * (data[i + 2] - 128 + brightness) + 128); // Blue
    }

    ctx.putImageData(imageData, 0, 0);
  }

  // Helper function to keep values in valid range
  function truncate(value) {
    return Math.min(255, Math.max(0, value));
  }

  // Add specifications selection functionality
  document.addEventListener('DOMContentLoaded', function() {
    const specCards = document.querySelectorAll('.specs-card');

    specCards.forEach(card => {
      card.addEventListener('click', function() {
        // Remove selected class from all cards
        specCards.forEach(c => c.classList.remove('selected'));
        // Add selected class to clicked card
        this.classList.add('selected');

        // Update the document type radio button based on selection
        const type = this.classList.contains('photo-specs') ? 'photo' :
                    this.classList.contains('signature-specs') ? 'signature' : 'document';
        document.querySelector(`input[name="docType"][value="${type}"]`).checked = true;
      });
    });
  });

  // Start photo dragging
  function startPhotoDrag(e) {
    photoState.dragging = true;
    photoState.lastX = e.clientX;
    photoState.lastY = e.clientY;
  }

  // Start photo dragging (touch)
  function startPhotoDragTouch(e) {
    e.preventDefault();
    if (e.touches.length === 1) {
      photoState.dragging = true;
      photoState.lastX = e.touches[0].clientX;
      photoState.lastY = e.touches[0].clientY;
    }
  }

  // Move photo while dragging
  function movePhoto(e) {
    if (photoState.dragging) {
      const dx = e.clientX - photoState.lastX;
      const dy = e.clientY - photoState.lastY;

      photoState.offsetX += dx;
      photoState.offsetY += dy;

      // Limit the offset to keep image within overlay
      limitPhotoOffset();

      photoState.lastX = e.clientX;
      photoState.lastY = e.clientY;

      renderPhotoCanvas();
    }
  }

  // Move photo while dragging (touch)
  function movePhotoTouch(e) {
    e.preventDefault();
    if (photoState.dragging && e.touches.length === 1) {
      const dx = e.touches[0].clientX - photoState.lastX;
      const dy = e.touches[0].clientY - photoState.lastY;

      photoState.offsetX += dx;
      photoState.offsetY += dy;

      // Limit the offset to keep image within overlay
      limitPhotoOffset();

      photoState.lastX = e.touches[0].clientX;
      photoState.lastY = e.touches[0].clientY;

      renderPhotoCanvas();
    }
  }

  // End photo dragging
  function endPhotoDrag() {
    photoState.dragging = false;
  }

  // Limit photo offset
  function limitPhotoOffset() {
    // Allow free movement
  }

  // Start signature dragging
  function startSignatureDrag(e) {
    signatureState.dragging = true;
    signatureState.lastX = e.clientX;
    signatureState.lastY = e.clientY;
  }

  // Start signature dragging (touch)
  function startSignatureDragTouch(e) {
    e.preventDefault();
    if (e.touches.length === 1) {
      signatureState.dragging = true;
      signatureState.lastX = e.touches[0].clientX;
      signatureState.lastY = e.touches[0].clientY;
    }
  }

  // Move signature while dragging
  function moveSignature(e) {
    if (signatureState.dragging) {
      const dx = e.clientX - signatureState.lastX;
      const dy = e.clientY - signatureState.lastY;

      signatureState.offsetX += dx;
      signatureState.offsetY += dy;

      // Limit the offset to keep signature within overlay
      limitSignatureOffset();

      signatureState.lastX = e.clientX;
      signatureState.lastY = e.clientY;

      renderSignatureCanvas();
    }
  }

  // Move signature while dragging (touch)
  function moveSignatureTouch(e) {
    e.preventDefault();
    if (signatureState.dragging && e.touches.length === 1) {
      const dx = e.touches[0].clientX - signatureState.lastX;
      const dy = e.touches[0].clientY - signatureState.lastY;

      signatureState.offsetX += dx;
      signatureState.offsetY += dy;

      // Limit the offset to keep signature within overlay
      limitSignatureOffset();

      signatureState.lastX = e.touches[0].clientX;
      signatureState.lastY = e.touches[0].clientY;

      renderSignatureCanvas();
    }
  }

  // End signature dragging
  function endSignatureDrag() {
    signatureState.dragging = false;
  }

  // Limit signature offset
  function limitSignatureOffset() {
    // Allow free movement
  }

  // Start crop dragging
  function startCropDrag(e) {
    e.preventDefault();

    // Check if we're dragging a handle
    const target = e.target;
    if (target.classList.contains('crop-handle')) {
      documentState.cropResizing = true;
      documentState.cropHandle = target.classList[1]; // tl, tr, bl, br
    } else {
      documentState.cropDragging = true;
    }

    documentState.lastX = e.clientX;
    documentState.lastY = e.clientY;
  }

  // Start crop dragging (touch)
  function startCropDragTouch(e) {
    e.preventDefault();

    if (e.touches.length === 1) {
      // Check if we're dragging a handle
      const target = e.target;
      if(target.classList.contains('crop-handle')) {
        documentState.cropResizing = true;
        documentState.cropHandle = target.classList[1]; // tl, tr, bl, br
      } else {
        documentState.cropDragging = true;
      }

      documentState.lastX = e.touches[0].clientX;
      documentState.lastY = e.touches[0].clientY;
    }
  }

  // Move crop overlay
  function moveCrop(e) {
    if (documentState.cropDragging) {
      const dx = e.clientX - documentState.lastX;
      const dy = e.clientY - documentState.lastY;

      documentState.cropX += dx;
      documentState.cropY += dy;

      // Limit the position
      limitCropPosition();

      documentState.lastX = e.clientX;
      documentState.lastY = e.clientY;

      updateCropOverlayPosition();
    } else if (documentState.cropResizing) {
      const dx = e.clientX - documentState.lastX;
      const dy = e.clientY - documentState.lastY;

      // Keep the original dimensions for maintaining aspect ratio
      const originalWidth = documentState.cropWidth;
      const originalHeight = documentState.cropHeight;

      // Adjust the crop area based on which handle is being dragged
      switch(documentState.cropHandle) {
        case 'tl': // Top Left
          documentState.cropX += dx;
          documentState.cropY += dy;
          documentState.cropWidth -= dx;
          documentState.cropHeight -= dy;
          break;
        case 'tr': // Top Right
          documentState.cropY += dy;
          documentState.cropWidth += dx;
          documentState.cropHeight -= dy;
          break;
        case 'bl': // Bottom Left
          documentState.cropX += dx;
          documentState.cropWidth -= dx;
          documentState.cropHeight += dy;
          break;
        case 'br': // Bottom Right
          documentState.cropWidth += dx;
          documentState.cropHeight += dy;
          break;
        case 'tc': // Top Center
          documentState.cropY += dy;
          documentState.cropHeight -= dy;
          break;
        case 'rc': // Right Center
          documentState.cropWidth += dx;
          break;
        case 'bc': // Bottom Center
          documentState.cropHeight += dy;
          break;
        case 'lc': // Left Center
          documentState.cropX += dx;
          documentState.cropWidth -= dx;
          break;
      }

      // Ensure minimum dimensions
      if (documentState.cropWidth < 50) {
        documentState.cropWidth = 50;
        if (['tl', 'bl', 'lc'].includes(documentState.cropHandle)) {
          documentState.cropX = documentState.cropX + (originalWidth - 50);
        }
      }

      if (documentState.cropHeight < 50) {
        documentState.cropHeight = 50;
        if (['tl', 'tr', 'tc'].includes(documentState.cropHandle)) {
          documentState.cropY = documentState.cropY + (originalHeight - 50);
        }
      }

      // Ensure minimum size
      if (documentState.cropWidth < 50) documentState.cropWidth = 50;
      if (documentState.cropHeight < 50) documentState.cropHeight = 50;

      // Limit the position and size
      limitCropPosition();

      documentState.lastX = e.clientX;
      documentState.lastY = e.clientY;

      updateCropOverlayPosition();
    }
  }

  // Move crop overlay (touch)
  function moveCropTouch(e) {
    e.preventDefault();

    if(e.touches.length === 1) {
      if (documentState.cropDragging) {
        const dx = e.touches[0].clientX - documentState.lastX;
        const dy = e.touches[0].clientY - documentState.lastY;

        documentState.cropX += dx;
        documentState.cropY += dy;

        // Limit the position
        limitCropPosition();

        documentState.lastX = e.touches[0].clientX;
        documentState.lastY = e.touches[0].clientY;

        updateCropOverlayPosition();
      } else if (documentState.cropResizing) {
        const dx = e.touches[0].clientX - documentState.lastX;
        const dy = e.touches[0].clientY - documentState.lastY;

        // Adjust the crop area based on which handle is being dragged
        if (documentState.cropHandle === 'tl') {
          documentState.cropX += dx;
          documentState.cropY += dy;
          documentState.cropWidth -= dx;
          documentState.cropHeight -= dy;
        } else if (documentState.cropHandle === 'tr') {
          documentState.cropY += dy;
          documentState.cropWidth += dx;
          documentState.cropHeight -= dy;
        } else if (documentState.cropHandle === 'bl') {
          documentState.cropX += dx;
          documentState.cropWidth -= dx;
          documentState.cropHeight += dy;
        } else if (documentState.cropHandle === 'br') {
          documentState.cropWidth+= dx;
          documentState.cropHeight += dy;
        }

        // Ensure minimum size
        if (documentState.cropWidth < 50) documentState.cropWidth = 50;
        if (documentState.cropHeight < 50) documentState.cropHeight = 50;

        // Limit the position and size
        limitCropPosition();

        documentState.lastX = e.touches[0].clientX;
        documentState.lastY = e.touches[0].clientY;

        updateCropOverlayPosition();
      }
    }
  }

  // End crop dragging
  function endCropDrag() {
    documentState.cropDragging = false;
    documentState.cropResizing = false;
    updateCropDimensionsInfo();
  }

  // Limit crop position
  function limitCropPosition() {
    // Get the container dimensions
    const container = documentCanvasContainer.getBoundingClientRect();

    // Ensure the crop area stays within the container
    if (documentState.cropX < 0) documentState.cropX = 0;
    if (documentState.cropY < 0) documentState.cropY = 0;
    if (documentState.cropX + documentState.cropWidth > container.width) {
      documentState.cropX = container.width - documentState.cropWidth;
    }
    if (documentState.cropY + documentState.cropHeight > container.height) {
      documentState.cropY = container.height - documentState.cropHeight;
    }
  }

  // Update crop overlay position
  function updateCropOverlayPosition() {
    const cropOverlay = document.getElementById('cropOverlay');
    if (!cropOverlay) return;

    cropOverlay.style.left = documentState.cropX + 'px';
    cropOverlay.style.top = documentState.cropY + 'px';
    cropOverlay.style.width = documentState.cropWidth + 'px';
    cropOverlay.style.height = documentState.cropHeight + 'px';

    // No document overlay to update
  }

  // Function to compress image to target file size with strict limits
  async function compressToTargetSize(canvas, targetSizeKB, format = 'jpeg', minSizeKB = 20) {
    // For editing or preview, always maintain original quality
    if (!targetSizeKB) {
      return canvas.toDataURL(`image/${format}`, 1.0);
    }

    // Set strict limits based on format
    const maxSizeKB = format === 'pdf' ? 299 : 49;
    const actualMinSizeKB = format === 'pdf' ? 150 : 20;
    
    // Ensure target size is within allowed limits
    targetSizeKB = Math.min(targetSizeKB, maxSizeKB);
    minSizeKB = Math.max(minSizeKB, actualMinSizeKB);

    // For download, compress iteratively with more precise control
    let quality = 0.95; // Start slightly below perfect quality for faster convergence
    let dataURL;
    let sizeKB;
    let attempts = 0;
    const maxAttempts = 50; // Increased attempts for better precision
    
    // Variables to track closest solutions so far
    let bestQuality = null;
    let bestSizeKB = null;
    let bestDataURL = null;
    
    // Binary search approach for faster convergence
    let minQuality = 0.05;
    let maxQuality = 1.0;
    
    do {
      if (format === 'pdf') {
        try {
          const { jsPDF } = window.jspdf;
          const pdf = new jsPDF({
            orientation: canvas.width > canvas.height ? 'landscape' : 'portrait',
            unit: 'px',
            format: [canvas.width, canvas.height]
          });

          pdf.addImage(canvas.toDataURL('image/jpeg', quality), 'JPEG', 0, 0, canvas.width, canvas.height);
          dataURL = pdf.output('datauristring');
        } catch (error) {
          console.error('PDF creation error:', error);
          // Fallback to JPEG if PDF creation fails
          dataURL = canvas.toDataURL('image/jpeg', quality);
        }
      } else {
        dataURL = canvas.toDataURL(`image/${format}`, quality);
      }

      sizeKB = Math.round((dataURL.length * 3) / 4 / 1024);
      attempts++;

      // Check if this is a valid solution within our range
      if (sizeKB <= maxSizeKB && sizeKB >= actualMinSizeKB) {
        // If we're within range, store this as a potential best solution
        if (bestQuality === null || 
            (sizeKB >= minSizeKB && sizeKB <= targetSizeKB && Math.abs(sizeKB - targetSizeKB) < Math.abs(bestSizeKB - targetSizeKB))) {
          bestQuality = quality;
          bestSizeKB = sizeKB;
          bestDataURL = dataURL;
        }
        
        // If we're very close to target, we can finish early
        if (Math.abs(sizeKB - targetSizeKB) < 2) {
          break;
        }
      }
      
      // Binary search approach
      if (sizeKB > targetSizeKB) {
        // Too big, decrease quality
        maxQuality = quality;
        quality = (minQuality + quality) / 2;
      } else if (sizeKB < minSizeKB) {
        // Too small, increase quality
        minQuality = quality;
        quality = (quality + maxQuality) / 2;
      } else {
        // We're in range but trying to get closer to target
        if (sizeKB < targetSizeKB) {
          minQuality = quality;
          quality = (quality + maxQuality) / 2;
        } else {
          maxQuality = quality;
          quality = (minQuality + quality) / 2;
        }
      }
      
      // Ensure we don't go outside valid quality range
      quality = Math.max(0.05, Math.min(0.95, quality));
      
    } while (attempts < maxAttempts);

    // If we found a valid solution within range, use it
    if (bestDataURL !== null) {
      console.log(`Compressed to ${bestSizeKB}KB with quality ${bestQuality.toFixed(2)}`);
      return bestDataURL;
    }
    
    // Last attempt - force to maximum allowed size if still too large
    if (sizeKB > maxSizeKB) {
      console.log(`Forcing size limit to ${maxSizeKB}KB (was ${sizeKB}KB)`);
      quality = 0.1; // Use lowest acceptable quality
      if (format === 'pdf') {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({
          orientation: canvas.width > canvas.height ? 'landscape' : 'portrait',
          unit: 'px',
          format: [canvas.width, canvas.height]
        });
        pdf.addImage(canvas.toDataURL('image/jpeg', quality), 'JPEG', 0, 0, canvas.width, canvas.height);
        return pdf.output('datauristring');
      } else {
        return canvas.toDataURL(`image/${format}`, quality);
      }
    }
    
    // If size is too small, return anyway
    return dataURL;
  }

  // Generate random 6-digit number
  function generateRandomNumber() {
    return Math.floor(100000 + Math.random() * 900000);
  }

  // Download photo with strict size limits
  async function downloadPhoto() {
    const tempCanvas = document.createElement('canvas');
    const selectionWidth = 243;
    const selectionHeight = 307;
    const randomNum = generateRandomNumber();
    tempCanvas.width = selectionWidth;
    tempCanvas.height = selectionHeight;

    const tempCtx = tempCanvas.getContext('2d');
    tempCtx.imageSmoothingEnabled = true;
    tempCtx.imageSmoothingQuality = 'high';
    
    // Calculate the exact area from the photo overlay
    const overlayArea = document.querySelector('.photo-overlay-area');
    const canvasRect = photoCanvas.getBoundingClientRect();
    const overlayRect = overlayArea.getBoundingClientRect();

    const scaleX = photoCanvas.width / canvasRect.width;
    const scaleY = photoCanvas.height / canvasRect.height;

    const sourceX = (overlayRect.left - canvasRect.left) * scaleX;
    const sourceY = (overlayRect.top - canvasRect.top) * scaleY;
    const sourceWidth = overlayRect.width * scaleX;
    const sourceHeight = overlayRect.height * scaleY;

    tempCtx.drawImage(photoCanvas,
      sourceX, sourceY, sourceWidth, sourceHeight,
      0, 0, tempCanvas.width, tempCanvas.height);

    // Compress with strict size limits (20-49KB)
    const targetSize = 45; // Target slightly below max for safety
    const dataURL = await compressToTargetSize(tempCanvas, targetSize, 'jpeg', 20);
    
    // Verify size before download
    const sizeKB = Math.round((dataURL.length * 3) / 4 / 1024);
    console.log(`Photo download size: ${sizeKB}KB`);
    
    downloadImage(dataURL, `photo_${randomNum}.jpg`);
  }

  // Download signature with strict size limits
  async function downloadSignature() {
    const tempCanvas = document.createElement('canvas');
    const selectionHeight = 128;
    const selectionWidth = 288;
    const randomNum = generateRandomNumber();
    tempCanvas.width = selectionWidth;
    tempCanvas.height = selectionHeight;

    const tempCtx = tempCanvas.getContext('2d');
    tempCtx.imageSmoothingEnabled = true;
    tempCtx.imageSmoothingQuality = 'high';
    
    // For signature, prefer to get content from visible area
    const overlayArea = document.querySelector('.signature-overlay-area');
    if (overlayArea) {
      const canvasRect = signatureCanvas.getBoundingClientRect();
      const overlayRect = overlayArea.getBoundingClientRect();

      const scaleX = signatureCanvas.width / canvasRect.width;
      const scaleY = signatureCanvas.height / canvasRect.height;

      const sourceX = (overlayRect.left - canvasRect.left) * scaleX;
      const sourceY = (overlayRect.top - canvasRect.top) * scaleY;
      const sourceWidth = overlayRect.width * scaleX;
      const sourceHeight = overlayRect.height * scaleY;

      tempCtx.drawImage(signatureCanvas,
        sourceX, sourceY, sourceWidth, sourceHeight,
        0, 0, tempCanvas.width, tempCanvas.height);
    } else {
      // Fallback to center if no overlay
      const centerX = (signatureCanvas.width - selectionWidth) / 2;
      const centerY = (signatureCanvas.height - selectionHeight) / 2;
      
      tempCtx.drawImage(signatureCanvas, 
        centerX, centerY, selectionWidth, selectionHeight,
        0, 0, tempCanvas.width, tempCanvas.height);
    }

    // Compress with strict size limits (20-49KB)
    const targetSize = 45; // Target slightly below max for safety
    const dataURL = await compressToTargetSize(tempCanvas, targetSize, 'jpeg', 20);
    
    // Verify size before download
    const sizeKB = Math.round((dataURL.length * 3) / 4 / 1024);
    console.log(`Signature download size: ${sizeKB}KB`);
    
    downloadImage(dataURL, `signature_${randomNum}.jpg`);
  }

  // Download document with strict size limits
  async function downloadDocument() {
    const cropOverlay = document.getElementById('cropOverlay');
    if (!cropOverlay) return;

    const tempCanvas = document.createElement('canvas');
    const overlayRect = cropOverlay.getBoundingClientRect();
    const documentRect = documentCanvas.getBoundingClientRect();

    // Calculate the scale ratio between displayed image and actual canvas
    const scaleX = documentCanvas.width / documentRect.width;
    const scaleY = documentCanvas.height / documentRect.height;

    // Calculate the actual position on the canvas based on visual position
    const cropX = (overlayRect.left - documentRect.left) * scaleX;
    const cropY = (overlayRect.top - documentRect.top) * scaleY;
    const cropWidth = overlayRect.width * scaleX;
    const cropHeight = overlayRect.height * scaleY;

    // Set canvas size to match the crop dimensions
    tempCanvas.width = cropWidth;
    tempCanvas.height = cropHeight;

    const tempCtx = tempCanvas.getContext('2d');
    tempCtx.imageSmoothingEnabled = true;
    tempCtx.imageSmoothingQuality = 'high';

    // First draw the processed image with filters
    const processedCanvas = document.createElement('canvas');
    processedCanvas.width = documentCanvas.width;
    processedCanvas.height = documentCanvas.height;
    const processedCtx = processedCanvas.getContext('2d');
    processedCtx.filter = `brightness(${documentState.brightness}%) contrast(${documentState.contrast}%)`;
    processedCtx.drawImage(originalImage, 0, 0, documentCanvas.width, documentCanvas.height);

    // Then crop the processed image
    tempCtx.drawImage(
      processedCanvas,
      cropX, cropY, cropWidth, cropHeight,
      0, 0, tempCanvas.width, tempCanvas.height
    );

    try {
      // Create PDF using jsPDF
      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF({
        orientation: tempCanvas.width > tempCanvas.height ? 'landscape' : 'portrait',
        unit: 'px',
        format: [tempCanvas.width, tempCanvas.height]
      });

      // Target size slightly below maximum for safety
      const targetSize = 290;
      
      // Add image to PDF with strict size limits (150-299KB)
      const imageData = await compressToTargetSize(tempCanvas, targetSize, 'pdf', 150);
      
      // Convert dataURL back to Blob to check size
      const binaryString = atob(imageData.split(',')[1]);
      const bytes = new Uint8Array(binaryString.length);
      for (let i = 0; i < binaryString.length; i++) {
        bytes[i] = binaryString.charCodeAt(i);
      }
      const blob = new Blob([bytes]);
      const pdfSizeKB = Math.round(blob.size / 1024);
      
      console.log(`Document PDF size: ${pdfSizeKB}KB`);
      
      // If PDF is somehow still too large, create directly with low quality
      if (pdfSizeKB > 299) {
        console.warn("PDF too large, using lower quality...");
        pdf.addImage(tempCanvas.toDataURL('image/jpeg', 0.5), 'JPEG', 0, 0, tempCanvas.width, tempCanvas.height);
      } else {
        // Use the compressed image data
        pdf.addImage(imageData, 'JPEG', 0, 0, tempCanvas.width, tempCanvas.height);
      }

      // Generate random name
      const randomNum = generateRandomNumber();
      // Save the PDF
      pdf.save(`document_${randomNum}.pdf`);
    } catch (error) {
      console.error('Error creating PDF:', error);
      // Fallback to direct image download if PDF creation fails
      const randomNum = generateRandomNumber();
      const imageData = await compressToTargetSize(tempCanvas, 290, 'jpeg', 150);
      downloadImage(imageData, `document_${randomNum}.jpg`);
    }
  }

  // Helper function to download an image
  function downloadImage(dataURL, filename) {
    const link = document.createElement('a');
    link.href = dataURL;
    link.download = filename;
    link.click();
  }

  // Preview button functionality will be added directly to the editor action bars

  // Function to show image preview
  function showImagePreview(type, canvas = null) {
    // Create preview overlay
    const previewOverlay = document.createElement('div');
    previewOverlay.className = 'preview-overlay';

    const previewContainer = document.createElement('div');
    previewContainer.className = 'preview-container';

    const previewHeader = document.createElement('div');
    previewHeader.className = 'preview-header';

    const previewTitle = document.createElement('h3');
    previewTitle.textContent = type.charAt(0).toUpperCase() + type.slice(1) + ' Preview';

    const closeBtn = document.createElement('button');
    closeBtn.className = 'preview-close-btn';
    closeBtn.innerHTML = '<i class="fas fa-times"></i>';
    closeBtn.addEventListener('click', function() {
      document.body.removeChild(previewOverlay);
    });

    previewHeader.appendChild(previewTitle);
    previewHeader.appendChild(closeBtn);

    const previewContent = document.createElement('div');
    previewContent.className = 'preview-content';

    const previewImage = document.createElement('img');
    previewImage.className = 'preview-image';

    // Get the appropriate canvas based on type
    let previewCanvas;
    if (type === 'photo') {
      previewCanvas = document.createElement('canvas');
      previewCanvas.width = 243; // Photo overlay width
      previewCanvas.height = 307; // Photo overlay height
      const tempCtx = previewCanvas.getContext('2d');
      tempCtx.imageSmoothingEnabled = true;
      tempCtx.imageSmoothingQuality = 'high';

      // Calculate the exact area from the photo overlay
      const overlayArea = document.querySelector('.photo-overlay-area');
      if (!overlayArea) return;
      const canvasRect = photoCanvas.getBoundingClientRect();
      const overlayRect = overlayArea.getBoundingClientRect();

      const scaleX = photoCanvas.width / canvasRect.width;
      const scaleY = photoCanvas.height / canvasRect.height;

      const sourceX = (overlayRect.left - canvasRect.left) * scaleX;
      const sourceY = (overlayRect.top - canvasRect.top) * scaleY;
      const sourceWidth = overlayRect.width * scaleX;
      const sourceHeight = overlayRect.height * scaleY;

      tempCtx.drawImage(photoCanvas,
        sourceX, sourceY, sourceWidth, sourceHeight,
        0, 0, previewCanvas.width, previewCanvas.height);

    } else if (type === 'signature') {
      previewCanvas = document.createElement('canvas');
      previewCanvas.width = 288; // Signature overlay width
      previewCanvas.height = 128; // Signature overlay height
      const tempCtx = previewCanvas.getContext('2d');
      tempCtx.imageSmoothingEnabled = true;
      tempCtx.imageSmoothingQuality = 'high';

      // Calculate the exact area from the signature overlay
      const overlayArea = document.querySelector('.signature-overlay-area');
      if (!overlayArea) return;
      const canvasRect = signatureCanvas.getBoundingClientRect();
      const overlayRect = overlayArea.getBoundingClientRect();

      const scaleX = signatureCanvas.width / canvasRect.width;
      const scaleY = signatureCanvas.height / canvasRect.height;

      const sourceX = (overlayRect.left - canvasRect.left) * scaleX;
      const sourceY = (overlayRect.top - canvasRect.top) * scaleY;
      const sourceWidth = overlayRect.width * scaleX;
      const sourceHeight = overlayRect.height * scaleY;

      tempCtx.drawImage(signatureCanvas,
        sourceX, sourceY, sourceWidth, sourceHeight,
        0, 0, previewCanvas.width, previewCanvas.height);

    } else if (type === 'document') {
      previewCanvas = canvas;
    }

    // Set the image source with maximum quality
    previewImage.src = previewCanvas.toDataURL('image/jpeg', 1.0);

    // Add file info
    const fileInfo = document.createElement('div');
    fileInfo.className = 'preview-file-info';

    const fileDimensions = document.createElement('p');
    fileDimensions.textContent = 'Dimensions: ' + previewCanvas.width + ' × ' + previewCanvas.height + ' px';

    fileInfo.appendChild(fileDimensions);

    // Add download button
    const downloadBtn = document.createElement('button');
    downloadBtn.className = 'preview-download-btn';
    downloadBtn.innerHTML = '<i class="fas fa-download"></i> Download';
    downloadBtn.addEventListener('click', function() {
      if (type === 'photo') {
        downloadPhoto();
      } else if (type === 'signature') {
        downloadSignature();
      } else if (type === 'document') {
        downloadDocument();
      }
      document.body.removeChild(previewOverlay);
    });

    previewContent.appendChild(previewImage);
    previewContent.appendChild(fileInfo);
    previewContent.appendChild(downloadBtn);

    previewContainer.appendChild(previewHeader);
    previewContainer.appendChild(previewContent);

    previewOverlay.appendChild(previewContainer);
    document.body.appendChild(previewOverlay);
  }

  // Function to show crop preview
  function showCropPreview() {
    const cropPreviewContainer = document.getElementById('cropPreviewContainer');
    const cropPreviewImage = document.getElementById('cropPreviewImage');
    const cropOverlay = document.getElementById('cropOverlay');
    const documentContainer = document.getElementById('documentCanvasContainer');

    if (!cropPreviewContainer || !cropPreviewImage || !cropOverlay || !documentContainer) return;

    const tempCanvas = document.createElement('canvas');
    const containerRect = documentContainer.getBoundingClientRect();
    const overlayRect = cropOverlay.getBoundingClientRect();

    // Calculate relative position within the container
    const relativeLeft = overlayRect.left - containerRect.left;
    const relativeTop = overlayRect.top - containerRect.top;

    // Calculate the scale ratio between displayed image and actual canvas
    const scaleX = documentCanvas.width / containerRect.width;
    const scaleY = documentCanvas.height / containerRect.height;

    // Set preview canvas dimensions
    tempCanvas.width = overlayRect.width;
    tempCanvas.height = overlayRect.height;

    const tempCtx = tempCanvas.getContext('2d');
    tempCtx.imageSmoothingEnabled = true;
    tempCtx.imageSmoothingQuality = 'high';

    // Calculate the actual crop coordinates on the original canvas
    const cropX = relativeLeft * scaleX;
    const cropY = relativeTop * scaleY;
    const cropWidth = overlayRect.width * scaleX;
    const cropHeight = overlayRect.height * scaleY;

    // Draw the cropped portion
    tempCtx.drawImage(
      documentCanvas,
      cropX, cropY, cropWidth, cropHeight,
      0, 0, tempCanvas.width, tempCanvas.height
    );

    // Update preview image
    cropPreviewImage.src = tempCanvas.toDataURL('image/jpeg', 1.0);
    cropPreviewContainer.style.display = 'block';

    // Update dimensions info using the actual pixel dimensions
    const dimensionsInfo = document.getElementById('cropDimensionsInfo');
    if (dimensionsInfo) {
      dimensionsInfo.textContent = `Selected area: ${Math.round(cropWidth)} × ${Math.round(cropHeight)} px`;
    }
  }

  // Function to update crop dimensions info
  function updateCropDimensionsInfo() {
    const cropDimensionsInfo = document.getElementById('cropDimensionsInfo');
    if (cropDimensionsInfo) {
      cropDimensionsInfo.textContent = `Selected area: ${documentState.cropWidth} × ${documentState.cropHeight} px`;
    }
  }

  });

window.scrollToSection = function(id) {
  if (id === 'top') {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    return;
  }

  // Show privacy section if hidden
  if (id === 'privacy') {
    const privacySection = document.querySelector('#privacy-policy');
    if (privacySection) {
      privacySection.style.display = 'block';
    }
  }

  // Map section ids to their selectors
  const sectionMap = {
    'specifications': '.specifications-section',
    'features': '.key-features-section',
    'how-to-use': '.how-to-use-section',
    'faq': '.faq-section',
    'privacy': '#privacy-policy'
  };

  const selector = sectionMap[id];
  if (selector) {
    const element = document.querySelector(selector);
    if (element) {
      // Close mobile menu if open
      const mobileMenu = document.getElementById('mobileMenu');
      if (mobileMenu && mobileMenu.classList.contains('active')) {
        mobileMenu.classList.remove('active');
      }

      // Calculate offset with fixed header
      const headerOffset = 80;
      setTimeout(() => {
        const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
        window.scrollTo({
          top: elementPosition - headerOffset,
          behavior: 'smooth'
        });
      }, 100);
    }
  }
}

// Add click event listeners when the DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  // Quick links click handling
  const quickLinks = document.querySelectorAll('.quick-links a');
  quickLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const section = this.getAttribute('onclick').match(/'([^']+)'/)[1];
      scrollToSection(section);
    });
  });
});
// Wait for DOM to be fully loaded for preset sections
(function() {
    function initPresetResizers() {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", initPresetResizers);
            return;
        }
        console.log("Initializing preset resizers...");

// Preset Resizer Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Preset configurations
    const presets = {
        'nsdl-photo': {
            widthCm: 2.5,
            heightCm: 3.5,
            dpi: 200,
            maxSize: 20
        },
        'nsdl-signature': {
            widthCm: 4.5,
            heightCm: 2,
            dpi: 200,
            maxSize: 10
        },
        'uti-photo': {
            width: 213,
            height: 213,
            dpi: 300,
            maxSize: 30
        },
        'uti-signature': {
            width: 400,
            height: 200,
            dpi: 600,
            maxSize: 60
        }
    };

    // State for each preset
    const presetStates = {};
    
    // Initialize each preset section
    Object.keys(presets).forEach(sectionId => {
        initPresetSection(sectionId, presets[sectionId]);
    });

    function initPresetSection(sectionId, config) {
        const fileInput = document.getElementById(`fileInput-${sectionId}`);
        const uploadBox = document.querySelector(`[data-section="${sectionId}"]`);
        const dpiInput = document.getElementById(`dpi-${sectionId}`);
        const calcDisplay = document.getElementById(`calc-${sectionId}`);
        const resizeBtn = document.getElementById(`resize-${sectionId}`);
        const resetBtn = document.getElementById(`reset-${sectionId}`);
        const canvas = document.getElementById(`canvas-${sectionId}`);
        const previewContainer = document.getElementById(`preview-${sectionId}`);
        
        if (!fileInput || !uploadBox) return;

        // Initialize state
        presetStates[sectionId] = {
            file: null,
            image: null,
            config: config
        };

        // File input change handler
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.match('image.*')) {
                handleFileSelect(sectionId, file);
            }
        });

        // Drag and drop handlers
        uploadBox.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.add('drag-over');
        });

        uploadBox.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.remove('drag-over');
        });

        uploadBox.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.remove('drag-over');
            
            const file = e.dataTransfer.files[0];
            if (file && file.type.match('image.*')) {
                fileInput.files = e.dataTransfer.files;
                handleFileSelect(sectionId, file);
            }
        });

        // Label's "for" attribute handles file input click automatically
        // No need for manual click handler to avoid double trigger

        // DPI change handler (for adjustable DPI sections)
        if (dpiInput && !dpiInput.hasAttribute('readonly')) {
            dpiInput.addEventListener('input', function() {
                updateCalculation(sectionId);
            });
        }

        // Resize button handler
        if (resizeBtn) {
            resizeBtn.addEventListener('click', function() {
                resizeImage(sectionId);
            });
        }

        // Reset button handler
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                resetPreset(sectionId);
            });
        }

        // Initial calculation display
        updateCalculation(sectionId);
    }

    function handleFileSelect(sectionId, file) {
        presetStates[sectionId].file = file;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                presetStates[sectionId].image = img;
                const resizeBtn = document.getElementById(`resize-${sectionId}`);
                const uploadBox = document.querySelector(`[data-section="${sectionId}"]`);
                const uploadContent = uploadBox ? uploadBox.querySelector('.upload-content') : null;
                const filePreview = document.getElementById(`preview-${sectionId}`);
                
                if (resizeBtn) {
                    resizeBtn.disabled = false;
                }
                
                // Hide upload box
                if (uploadBox) {
                    uploadBox.style.display = 'none';
                }
                
                // Create file preview like home section
                if (filePreview) {
                    filePreview.innerHTML = '';
                    
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';
                    
                    const fileImage = document.createElement('img');
                    fileImage.className = 'file-image';
                    fileImage.src = e.target.result;
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'file-info';
                    
                    const fileDetails = document.createElement('div');
                    fileDetails.className = 'file-details';
                    
                    const fileDimensions = document.createElement('div');
                    fileDimensions.className = 'file-dimensions';
                    fileDimensions.textContent = `${img.width} × ${img.height} px`;
                    
                    const fileSize = document.createElement('div');
                    fileSize.className = 'file-size';
                    const fileSizeKB = (file.size / 1024).toFixed(2);
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    fileSize.textContent = file.size >= 1024 * 1024 ? `${fileSizeMB} MB` : `${fileSizeKB} KB`;
                    
                    fileDetails.appendChild(fileDimensions);
                    fileDetails.appendChild(fileSize);
                    
                    const deleteBtn = document.createElement('button');
                    deleteBtn.className = 'delete-btn';
                    deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
                    deleteBtn.setAttribute('aria-label', 'Delete file');
                    deleteBtn.onclick = function() {
                        resetPreset(sectionId);
                    };
                    
                    fileInfo.appendChild(fileDetails);
                    fileInfo.appendChild(deleteBtn);
                    
                    fileItem.appendChild(fileImage);
                    fileItem.appendChild(fileInfo);
                    
                    filePreview.appendChild(fileItem);
                    filePreview.style.display = 'block';
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    function updateCalculation(sectionId) {
        const config = presetStates[sectionId].config;
        const dpiInput = document.getElementById(`dpi-${sectionId}`);
        const calcDisplay = document.getElementById(`calc-${sectionId}`);
        
        if (!calcDisplay) return;

        let width, height;
        
        if (config.widthCm && config.heightCm) {
            // Calculate from cm
            const dpi = dpiInput ? parseInt(dpiInput.value) || config.dpi : config.dpi;
            width = Math.round((config.widthCm / 2.54) * dpi);
            height = Math.round((config.heightCm / 2.54) * dpi);
        } else {
            // Fixed pixel dimensions
            width = config.width;
            height = config.height;
        }

        calcDisplay.textContent = `${width}px (W) x ${height}px (H)`;
    }

    function resizeImage(sectionId) {
        const state = presetStates[sectionId];
        if (!state.image) return;

        const config = state.config;
        const canvas = document.getElementById(`canvas-${sectionId}`);
        const ctx = canvas.getContext('2d');
        const uploadBox = document.querySelector(`[data-section="${sectionId}"]`);
        const dpiInput = document.getElementById(`dpi-${sectionId}`);

        let targetWidth, targetHeight;

        if (config.widthCm && config.heightCm) {
            const dpi = dpiInput ? parseInt(dpiInput.value) || config.dpi : config.dpi;
            targetWidth = Math.round((config.widthCm / 2.54) * dpi);
            targetHeight = Math.round((config.heightCm / 2.54) * dpi);
        } else {
            targetWidth = config.width;
            targetHeight = config.height;
        }

        // Set canvas size
        canvas.width = targetWidth;
        canvas.height = targetHeight;

        // Draw white background
        ctx.fillStyle = '#FFFFFF';
        ctx.fillRect(0, 0, targetWidth, targetHeight);

        // Calculate scaling to fit image
        const scale = Math.max(targetWidth / state.image.width, targetHeight / state.image.height);
        const scaledWidth = state.image.width * scale;
        const scaledHeight = state.image.height * scale;
        const x = (targetWidth - scaledWidth) / 2;
        const y = (targetHeight - scaledHeight) / 2;

        // Draw image
        ctx.drawImage(state.image, x, y, scaledWidth, scaledHeight);

        // Compress to target size
        compressCanvas(canvas, config.maxSize, function(compressedDataUrl) {
            // Show canvas in upload box - remove inline display:none
            canvas.style.display = 'block';
            canvas.style.visibility = 'visible';
            
            // Ensure upload box has has-image class
            if (uploadBox) {
                uploadBox.classList.add('has-image');
            }
            
            // Add download button if not exists
            addDownloadButton(sectionId, compressedDataUrl, targetWidth, targetHeight);
        });
    }

    function compressCanvas(canvas, maxSizeKB, callback) {
        let quality = 0.9;
        let dataUrl = canvas.toDataURL('image/jpeg', quality);

        function getFileSizeKB(dataUrl) {
            const base64 = dataUrl.split(',')[1];
            const bytes = atob(base64).length;
            return bytes / 1024;
        }

        function compress() {
            dataUrl = canvas.toDataURL('image/jpeg', quality);
            const sizeKB = getFileSizeKB(dataUrl);

            if (sizeKB <= maxSizeKB || quality <= 0.1) {
                callback(dataUrl);
            } else {
                quality -= 0.05;
                setTimeout(compress, 10);
            }
        }

        compress();
    }

    function addDownloadButton(sectionId, dataUrl, width, height) {
        const downloadBtn = document.getElementById(`download-${sectionId}`);
        const resizeBtn = document.getElementById(`resize-${sectionId}`);
        
        // Store dataUrl for download
        presetStates[sectionId].resizedDataUrl = dataUrl;
        presetStates[sectionId].resizedDimensions = { width, height };

        if (downloadBtn) {
            downloadBtn.onclick = function() {
                const link = document.createElement('a');
                const filename = `${sectionId}-${width}x${height}`;
                
                link.download = `${filename}.jpg`;
                link.href = dataUrl;
                link.click();
            };

            downloadBtn.style.display = 'inline-flex';
        }
        
        // Hide resize button after resizing is complete
        if (resizeBtn) {
            resizeBtn.style.display = 'none';
        }
    }

    function resetPreset(sectionId) {
        const fileInput = document.getElementById(`fileInput-${sectionId}`);
        const uploadBox = document.querySelector(`[data-section="${sectionId}"]`);
        const resizeBtn = document.getElementById(`resize-${sectionId}`);
        const filePreview = document.getElementById(`preview-${sectionId}`);
        const downloadBtn = document.getElementById(`download-${sectionId}`);

        // Reset state
        presetStates[sectionId].file = null;
        presetStates[sectionId].image = null;
        presetStates[sectionId].resizedDataUrl = null;
        presetStates[sectionId].resizedDimensions = null;

        // Reset UI
        if (fileInput) fileInput.value = '';
        
        // Show upload box
        if (uploadBox) {
            uploadBox.style.display = 'block';
        }
        
        // Hide file preview
        if (filePreview) {
            filePreview.style.display = 'none';
            filePreview.innerHTML = '';
        }
        
        // Hide download button
        if (downloadBtn) downloadBtn.style.display = 'none';
        
        // Show resize button again and disable it
        if (resizeBtn) {
            resizeBtn.style.display = '';
            resizeBtn.disabled = true;
        }

        // Reset DPI to default (if not readonly)
        const dpiInput = document.getElementById(`dpi-${sectionId}`);
        if (dpiInput && !dpiInput.hasAttribute('readonly')) {
            dpiInput.value = presets[sectionId].dpi;
            updateCalculation(sectionId);
        }
    }
});

    }
    initPresetResizers();
    
    // Custom Centimeter Resizer Functionality
    function initCustomCmResizer() {
        const widthInput = document.getElementById('custom-width');
        const heightInput = document.getElementById('custom-height');
        const dpiInput = document.getElementById('custom-dpi');
        const maxSizeInput = document.getElementById('custom-maxsize');
        const fileInput = document.getElementById('fileInput-custom-cm');
        const uploadBox = document.querySelector('[data-section="custom-cm"]');
        const uploadArea = document.getElementById('upload-custom-cm');
        const resizeBtn = document.getElementById('resize-custom-cm');
        const resetBtn = document.getElementById('reset-custom-cm');
        const filePreview = document.getElementById('preview-custom-cm');
        const downloadBtn = document.getElementById('download-custom-cm');
        
        if (!fileInput || !uploadBox) return;
        
        let customState = {
            file: null,
            image: null,
            resizedDataUrl: null
        };
        
        // File input change
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.match('image.*')) {
                handleCustomFileSelect(file);
            }
        });
        
        // Drag and drop
        uploadBox.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.add('drag-over');
        });
        
        uploadBox.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.remove('drag-over');
        });
        
        uploadBox.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.remove('drag-over');
            
            const file = e.dataTransfer.files[0];
            if (file && file.type.match('image.*')) {
                handleCustomFileSelect(file);
            }
        });
        
        // Handle file selection
        function handleCustomFileSelect(file) {
            customState.file = file;
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    customState.image = img;
                    resizeBtn.disabled = false;
                    
                    // Hide upload box
                    uploadBox.style.display = 'none';
                    
                    // Show preview container
                    if (filePreview) {
                        filePreview.style.display = 'block';
                        
                        // Calculate file size
                        const fileSizeKB = (file.size / 1024).toFixed(2);
                        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                        const displaySize = file.size >= 1024 * 1024 ? `${fileSizeMB} MB` : `${fileSizeKB} KB`;
                        
                        // Create file item structure
                        filePreview.innerHTML = `
                            <div class="file-item">
                                <img src="${e.target.result}" alt="Preview" class="file-image">
                                <div class="file-info">
                                    <span class="file-dimension">${img.width} × ${img.height} px</span>
                                    <span class="file-size">${displaySize}</span>
                                    <button class="delete-btn" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        
                        // Add delete button functionality
                        const deleteBtn = filePreview.querySelector('.delete-btn');
                        if (deleteBtn) {
                            deleteBtn.addEventListener('click', resetCustom);
                        }
                    }
                };
                img.src = e.target.result;
            };
            
            reader.readAsDataURL(file);
        }
        
        // Resize button click
        resizeBtn.addEventListener('click', function() {
            if (!customState.image) return;
            
            const widthCm = parseFloat(widthInput.value);
            const heightCm = parseFloat(heightInput.value);
            const dpi = parseInt(dpiInput.value);
            const maxSizeKB = parseInt(maxSizeInput.value);
            
            // Calculate pixels from cm
            const widthPx = Math.round((widthCm / 2.54) * dpi);
            const heightPx = Math.round((heightCm / 2.54) * dpi);
            
            // Create canvas for resizing
            const canvas = document.createElement('canvas');
            canvas.width = widthPx;
            canvas.height = heightPx;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(customState.image, 0, 0, widthPx, heightPx);
            
            // Compress to target size
            compressToSize(canvas, maxSizeKB, function(finalDataUrl) {
                customState.resizedDataUrl = finalDataUrl;
                
                // Update preview with resized image
                const previewImg = filePreview.querySelector('.file-image');
                if (previewImg) {
                    previewImg.src = finalDataUrl;
                }
                
                // Update file info with new dimensions
                const dimensionSpan = filePreview.querySelector('.file-dimension');
                if (dimensionSpan) {
                    dimensionSpan.textContent = `${widthPx} × ${heightPx} px`;
                }
                
                // Show download button and hide resize button
                if (downloadBtn) {
                    downloadBtn.onclick = function() {
                        const link = document.createElement('a');
                        const filename = `custom-resized-${widthCm}x${heightCm}cm-${dpi}dpi`;
                        link.download = `${filename}.jpg`;
                        link.href = finalDataUrl;
                        link.click();
                    };
                    downloadBtn.style.display = 'inline-flex';
                }
                
                // Hide resize button after resizing is complete
                resizeBtn.style.display = 'none';
            });
        });
        
        // Reset button click
        resetBtn.addEventListener('click', resetCustom);
        
        // Reset function
        function resetCustom() {
            customState.file = null;
            customState.image = null;
            customState.resizedDataUrl = null;
            fileInput.value = '';
            resizeBtn.disabled = true;
            
            // Hide preview
            if (filePreview) {
                filePreview.style.display = 'none';
                filePreview.innerHTML = '';
            }
            
            // Show upload box
            uploadBox.style.display = 'flex';
            
            // Hide download button
            if (downloadBtn) downloadBtn.style.display = 'none';
            
            // Show resize button again
            resizeBtn.style.display = '';
            
            // Reset inputs to default
            widthInput.value = '2.5';
            heightInput.value = '3.5';
            dpiInput.value = '200';
            maxSizeInput.value = '20';
        }
        
        // Compress image to target size
        function compressToSize(canvas, maxSizeKB, callback) {
            let quality = 0.9;
            let dataUrl = canvas.toDataURL('image/jpeg', quality);
            
            function checkSize() {
                const sizeKB = Math.round((dataUrl.length * 3/4) / 1024);
                if (sizeKB <= maxSizeKB || quality <= 0.1) {
                    callback(dataUrl);
                } else {
                    quality -= 0.05;
                    dataUrl = canvas.toDataURL('image/jpeg', quality);
                    setTimeout(checkSize, 10);
                }
            }
            
            checkSize();
        }
    }
    
    // Initialize custom cm resizer
    if (document.getElementById('custom-cm-resizer')) {
        initCustomCmResizer();
    }
})();
