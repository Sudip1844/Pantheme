# PAN Card Resizer - Online Image Tool

## Overview
PAN Card Resizer is a client-side web application designed to resize and compress PAN card photos, signatures, and documents to meet NSDL/UTI requirements. It operates entirely in the browser, ensuring user privacy and fast performance by processing images locally without server uploads. The application offers a comprehensive suite of tools for image manipulation, including custom centimeter resizing, and is available as both a standalone HTML site and a WordPress theme. Its primary purpose is to simplify compliance with official document submission standards for PAN cards, catering to a broad user base with an intuitive and efficient online tool. The project aims to be the go-to solution for PAN card image resizing, providing a secure, fast, and user-friendly experience.

## Recent Changes

### Latest Updates - October 30, 2025

#### Image Compression Algorithm Optimization (Binary Search)

**Problem Identified:**
- Previous linear compression algorithm produced output files significantly smaller than target size
- Example: 20 KB max size setting resulted in only 11 KB output (50-60% of target)
- Algorithm started at quality 0.9 and reduced by 0.05 steps until size was under limit
- Never increased quality back up, resulting in overly compressed images

**Solution Implemented - Binary Search Algorithm:**
- **Algorithm Type**: Binary search between minQuality (0.5) and maxQuality (0.95)
- **Target Range**: 95-100% of maximum allowed size (e.g., 19-20 KB for 20 KB limit)
- **Iterations**: Maximum 20 iterations or quality difference < 0.01
- **Smart Tracking**: Keeps track of best valid result throughout search
- **Precision**: Adjusts quality range based on current size (too large → reduce quality, too small → increase quality)

**Technical Implementation:**
- Modified `compressCanvas()` function in main-script.js
- Replaced linear quality reduction with binary search approach
- Algorithm stops when size is within 95-100% of target or max iterations reached
- Falls back to best found result if perfect match not achieved

**Impact:**
- Output file sizes now consistently reach 95-100% of target size
- Better image quality while staying within limits
- Applies to all 5 preset sections, custom CM resizer, AND home section editor
- More predictable and optimal compression results

**Example Results:**
- Preset Sections: 20 KB limit → 19-20 KB output (95-100%)
- Home Section Photo/Signature: 50 KB limit → 47-50 KB output (95-100%)
- Home Section Document: 300 KB limit → 285-300 KB output (95-100%)

**Home Section Specific Optimization:**
- Modified `compressToTargetSize()` function to target 95-100% range
- Photo/Signature: maxSizeKB = 50 KB, targetMin = 47 KB (95%)
- Document (PDF): maxSizeKB = 300 KB, targetMin = 285 KB (95%)
- Simplified binary search logic for faster convergence
- Accepts immediately when size is in 95-100% range

#### UI Improvements - Container and Label Optimization

**1. Single Container for Filename Input (Space Optimization)**
- **Problem Fixed**: Filename input area used nested double containers (outer green container + inner white input) which consumed excessive space
- **Solution**: 
  - **JavaScript**: Removed `.resized-meta-content` wrapper div from main-script.js (both preset and custom CM sections)
  - **HTML**: Input field now sits directly inside `.resized-meta` container
  - **CSS**: Made `.resized-meta` completely transparent (removed background and border)
  - All styling moved to `.filename-input` itself (light green background #e8f5e9, green border #a5d6a7)
- **Impact**: Single unified input field, significantly reduced vertical space, cleaner UI
- **Result**: No more double container - only one visible input box with green styling

**2. Custom CM Resizer - Labels Inside Input Boxes**
- **Enhancement**: Moved input labels from outside/above input boxes to inside on the right side
- **Changes**: 
  - Restructured HTML in preset-resizers.php with `.input-with-label` wrapper
  - Added `.input-label-inside` span elements positioned absolutely on the right
  - Labels now display as: `Width (cm)`, `Height (cm)`, `Resolution (DPI)`, `Max Size (KB)` inside the input boxes
  - Input fields have right padding (140px) to prevent text overlap with labels
- **CSS Implementation**: 
  - Position: absolute with right: 14px alignment
  - Labels are non-interactive (pointer-events: none) and non-selectable
  - Color: #9ca3af for subtle visibility
- **Impact**: Cleaner vertical layout, reduced visual clutter, modern input design pattern

#### Filename Input Placeholder Simplified
- **UI Enhancement**: Simplified filename input placeholder text for better clarity
- **Changes**: Changed placeholder from "File name (optional): Enter custom filename..." to just "File name (optional)"
- **Affected Areas**: 
  - All 4 preset sections (NSDL Photo, NSDL Signature, UTI Photo, UTI Signature)
  - Custom CM Resizer section
- **Impact**: Cleaner, less cluttered interface with concise placeholder text

#### UTI Photograph & UTI Signature DPI Edit Enabled
- **Problem Fixed**: UTI photograph and UTI signature sections had `readonly` attribute on DPI input fields, preventing users from changing DPI values
- **Solution Implemented**: 
  - Removed `readonly` attribute from both UTI DPI input fields (lines 150 and 204 in preset-resizers.php)
  - Added min/max constraints for better UX: `min="50" max="600"` for UTI Photo, `min="50" max="1200"` for UTI Signature
  - Now users can adjust DPI in UTI sections just like NSDL sections
- **Impact**: All 5 preset sections now have fully functional DPI adjustment capability
- **Technical Details**: DPI change listeners in main-script.js now properly fire for UTI sections since readonly attribute no longer blocks input events

### Previous Updates - October 29, 2025 (Image Quality Preservation Feature)

#### Original Image Preservation Across Multiple Resizes
- **Problem Solved**: Previously, when users changed DPI and resized multiple times, the image quality degraded because each resize operated on the previously resized image
- **Solution Implemented**: Added `originalDataUrl` storage system
  - When a file is uploaded, the original data URL is stored separately in state (both preset and Custom CM sections)
  - On every resize operation, a fresh Image object is created from the stored `originalDataUrl`
  - Canvas drawing always uses this pristine original image, never the resized preview
  - Result: Users can change DPI or other parameters and resize multiple times without any quality loss
- **User Experience Enhancement**: When DPI or parameters change
  - The resized preview image is automatically replaced with the original image
  - Download button switches back to Resize button
  - Green filename container is hidden
  - This visual feedback clearly shows that a new resize operation is needed

#### Custom Filename Support for Custom CM Resizer
- **Feature Added**: Custom CM Resizer section now has custom filename input (matching the 4 preset sections)
- **Implementation**: Green container with filename input field appears after resizing
- **Behavior**: Optional filename input; if empty, uses default format `custom-resized-{width}x{height}cm-{dpi}dpi.jpg`

### Previous Updates - October 29, 2025

#### Preview Container Shows Resized Image Details
- **Preview Container Update**: Modified to display resized image dimensions and file size instead of original
  - After resizing, preview container updates to show: `197 × 276 px` and `17.93 KB` (resized values)
  - Previously showed original dimensions (e.g., 4608 × 3456 px) which was incorrect
  - JavaScript automatically updates `.file-dimensions` and `.file-size` spans with resized metadata
  
#### Green Container Simplified to Filename Input Only
- **Green Container Redesign**: Removed dimension/size display, keeping only filename input
  - Previous: Showed resized dimensions + file size + filename input
  - Current: Only shows filename input with placeholder "File name (optional): Enter custom filename..."
  - Cleaner, less cluttered interface focusing on the single action users need
  - CSS updated to support simplified block-level structure
  
#### DPI Change Auto-Reset Functionality
- **Smart UI Reset on Parameter Change**: Download button automatically reverts to Resize button when parameters change
  - **Preset Sections (NSDL Photo, NSDL Signature)**: When DPI value is adjusted
    - Hides Download button and shows Resize button
    - Clears and hides the green filename container
    - Updates output pixel calculation display
  - **Custom CM Section**: When any input changes (Width, Height, DPI, or Max Size)
    - Resets Download button to Resize button
    - Ensures users must re-resize after changing parameters
  - Prevents download of outdated resized images with wrong dimensions
  - Provides clear visual feedback that resize operation needs to be performed again

### Previous Updates - October 28, 2025

#### Dedicated Resized Info Container with Green Styling
- **Changed Label Text**: Updated "Calculated:" to "Output:" in all 4 preset sections (NSDL Photo, NSDL Signature, UTI Photo, UTI Signature) for better clarity
  - The 5th section (Custom CM Resizer) was not modified as it doesn't have this label
- **New Dedicated Resized Info Container**: Complete redesign of how resized image information is displayed
  - **Location**: New container appears between the preview area and DPI/Output controls
  - **Visual Design**: Light green background (#e8f5e9) with green border for clear visual distinction
  - **Layout**: 
    - Left side: Resized image dimensions and file size (e.g., "197 × 276 px" and "12.31 KB")
    - Right side: Optional filename input field
  - **Clean Preview**: Image preview container remains clean - no dimension/size clutter
  - **Responsive**: Container stacks vertically on mobile devices
  - **File Size Calculation**: Accurately calculated from compressed data URL using atob()
  - **Filename Preservation**: Custom filename is preserved if user resizes the same image multiple times
  - **Reset Behavior**: Container is hidden and cleared when Reset button is clicked
- **Implementation Details**:
  - Added `.resized-meta` placeholder div in preset-resizers.php for all 4 sections
  - Modified resizeImage() to populate the green container instead of modifying preview
  - Added comprehensive CSS styling with green color scheme (#1b5e20, #2e7d32, #4caf50)
  - Container is initially hidden (`display: none !important`) and only shows after resize
  - Reset button clears and hides the container

### Previous Updates - Image Preview & Download Enhancements
- **Fixed Canvas Rendering Bug**: Added hidden canvas elements to all 5 preset sections to resolve "Cannot read properties of null (reading 'getContext')" error
- **Improved Image Preview Flow**: Modified resizeImage() function to replace the uploaded preview image in-place instead of creating a new container
  - Resized image now appears in the SAME container where the original upload preview was shown
  - Eliminates visual clutter and maintains consistent layout
- **Custom Filename Support**: Added optional filename input field after resizing
  - Replaces the file details (dimensions, size) and delete button with a "File name (optional)" input box
  - Input box appears in the `.file-info` container (where the red delete button was previously shown)
  - Users can enter custom filename before downloading (optional)
  - If no custom name is provided, uses default format: `{sectionId}-{width}x{height}.jpg`
  - Input field has focus/blur border color transition for better UX
- **Button Sizing Consistency**: Fixed download button styling to match resize button dimensions
  - Applied shared CSS rules (flex: 1, same padding, border-radius) to both `.resize-btn` and `.download-btn-preset`
  - Download button now maintains the exact same size as the Resize button for visual consistency

### Previous Button Flow Update
- Modified the preset resizer sections (NSDL Photo, NSDL Signature, UTI Photo, UTI Signature, and Custom CM Resizer) to improve UX by showing only 2 buttons at a time instead of 3.
  - Initially shows: "Resize Image" + "Reset" buttons
  - After clicking "Resize Image": Hides "Resize Image" and shows "Download" button (only "Download" + "Reset" visible)
  - After clicking "Reset": Shows "Resize Image" again and hides "Download" button
  - This creates a cleaner, less cluttered interface with better visual flow

## User Preferences
Preferred communication style: Simple, everyday language (Bengali/Bangla and English).

## System Architecture

### Frontend Architecture
The application is built as a Single-Page Application (SPA) using vanilla JavaScript, focusing on client-side processing without external frameworks. It employs a mobile-first responsive design with breakpoint-based media queries and touch-optimized interactions. Performance is a key consideration, with optimizations such as critical rendering path optimization, lazy loading of non-critical resources, DNS prefetching, preconnect hints, and LCP element marking for Core Web Vitals.

### Image Processing Architecture
All image manipulation, including resizing, compression, rotation, zoom, brightness, contrast adjustments, and white background generation, occurs client-side using the HTML Canvas API. The tool supports various input formats and specific output requirements (e.g., 200x200px, 3.5x2.5cm, specific KB limits). PDF processing capabilities are integrated using `pdf-lib` and `jspdf` for document manipulation and PDF to JPG conversion.

### WordPress Theme Architecture
The application is structured as a custom WordPress theme, converting the standalone HTML/CSS/JS into a WordPress-compatible template-based architecture. It adheres to WordPress theme standards, organizing assets in dedicated directories and utilizing modular template parts for reusability. The theme maintains all original functionality while integrating seamlessly into the WordPress ecosystem, including WordPress-specific SEO optimizations.

### UI Component Design
The interface includes an accordion-style FAQ component with ARIA-compliant accessibility attributes and keyboard navigation. The overall design emphasizes a clean, modern light theme with professional styling, including floating card headers, rounded corners, and consistent spacing. Dedicated preset sections for NSDL and UTI photographs and signatures, along with a custom centimeter resizer, provide tailored user experiences.

### SEO and Performance Optimization
The system incorporates advanced SEO features, including context-aware canonical URLs, comprehensive meta tags (description, keywords, author, robots), Open Graph and Twitter Card tags for social sharing, and JSON-LD structured data (WebApplication, FAQPage schemas). Performance optimizations include browser caching strategies (max-age=3600), deferred script loading, critical CSS and JS preloading, asynchronous loading of non-critical resources, and DNS prefetching/preconnect for CDN resources.

## External Dependencies

### JavaScript Libraries
-   `jspdf` (v3.0.0): For PDF generation.
-   `pdf-lib` (v1.17.1): For reading and modifying PDF documents.
-   `@pdf-lib/standard-fonts` (v1.0.0): Provides standard font support for PDF operations.
-   `@pdf-lib/upng` (v1.0.1): Used for PNG compression within PDF contexts.
-   `pako` (v1.0.x): A compression library utilized by PDF-related dependencies.
-   `@babel/runtime` (v7.26.10): Babel runtime helpers.
-   `regenerator-runtime` (v0.14.0): Provides runtime support for async/await.

### CDN Resources
-   **Font Awesome 6.4.0**: Icon library loaded asynchronously from `cdnjs.cloudflare.com`.

### External Services
-   **cdnjs.cloudflare.com**: Serves as the primary CDN for third-party libraries, with DNS prefetch and preconnect configured for performance.