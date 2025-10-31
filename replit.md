# PAN Card Resizer - Online Image Tool

## Overview
PAN Card Resizer is a client-side web application designed to resize and compress PAN card photos, signatures, and documents to meet NSDL/UTI requirements. It operates entirely in the browser, ensuring user privacy and fast performance by processing images locally without server uploads. The application offers a comprehensive suite of tools for image manipulation, including custom centimeter resizing, and is available as both a standalone HTML site and a WordPress theme. Its primary purpose is to simplify compliance with official document submission standards for PAN cards, catering to a broad user base with an intuitive and efficient online tool. The project aims to be the go-to solution for PAN card image resizing, providing a secure, fast, and user-friendly experience.

## Recent Changes

### Latest Updates - October 31, 2025

#### Dynamic Section-Specific SEO Implementation

**1. Hash-Based SEO Router**
- **Feature**: Implemented advanced SEO system that provides unique metadata for each of the 5 editor sections
- **Technology**: JavaScript-based SEO router with hash-change detection
- **Implementation**:
  - Each section (NSDL Photo, NSDL Signature, UTI Photo, UTI Signature, Custom CM) has unique SEO metadata
  - Dynamically updates meta tags, title, canonical URL, and structured data on section navigation
  - Uses URL hash fragments (#nsdl-photo, #nsdl-signature, etc.) for section identification
- **Impact**: Search engines can now index each editor section separately with specific keywords and descriptions

**2. Section-Specific Metadata Registry**
- **Created**: Comprehensive metadata registry in `index.php` with inline JavaScript exposure
- **Content for Each Section**:
  - Unique page title (e.g., "NSDL (Protean) Photograph Resize - 3.5cm x 2.5cm, 200 DPI, 20 KB")
  - Descriptive meta description with specific requirements
  - Targeted keywords (e.g., "NSDL photo resize, Protean PAN photo, NSDL photograph 3.5x2.5cm")
  - Section-specific canonical URLs with hash fragments
  - Open Graph titles and Twitter Card titles
- **Sections Covered**:
  - Default (Homepage)
  - NSDL Photo (#nsdl-photo)
  - NSDL Signature (#nsdl-signature)
  - UTI Photo (#uti-photo)
  - UTI Signature (#uti-signature)
  - Custom CM Resizer (#custom-cm-resizer)

**3. Enhanced JSON-LD Structured Data**
- **Implementation**: Section-specific WebApplication schemas for each editor
- **Features for Each Section**:
  - Unique application name and description
  - Section-specific URL with hash fragment
  - Detailed feature list matching section capabilities
  - Proper schema.org compliance for search engine rich results
- **Format**: All structured data uses proper INR currency and free pricing (0.00)

**4. JavaScript SEO Router (main-script.js)**
- **Functionality**:
  - Listens for `hashchange` events to detect section navigation
  - Automatically updates `document.title` on section change
  - Dynamically swaps meta tag content (description, keywords)
  - Updates Open Graph and Twitter Card tags in real-time
  - Modifies canonical link href to include current hash
  - Replaces JSON-LD structured data content without page reload
- **Performance**: Updates occur within 100ms of hash change
- **Fallback**: Maintains default SEO when JavaScript is disabled

**5. WordPress Theme Compatibility**
- **Added**: Parallel implementation in `functions.php` for WordPress compatibility
- **Functions Created**:
  - `pan_resizer_get_section_metadata()`: Registry of all section metadata
  - `pan_resizer_get_current_section()`: Hash/query parameter detection
  - `pan_resizer_add_seo_meta_tags()`: Dynamic meta tag rendering
  - `pan_resizer_get_section_structured_data()`: Section-specific schemas
  - `pan_resizer_add_structured_data()`: JSON-LD output
  - `wp_localize_script()`: JavaScript metadata exposure (WordPress-specific)
- **Note**: WordPress functions are prepared but currently unused in standalone build

**Technical Implementation**:
- Modified files:
  - `index.php`: Added comprehensive inline JavaScript SEO metadata registry
  - `pan-resizer-theme/assets/js/main-script.js`: Added 150+ lines of SEO router logic
  - `pan-resizer-theme/functions.php`: Added WordPress-compatible SEO functions (300+ lines)
- **SEO Benefits**:
  - Better search engine indexing for specific use cases
  - Higher ranking potential for targeted keywords (NSDL photo, UTI signature, etc.)
  - Improved CTR with descriptive titles and meta descriptions
  - Enhanced social media sharing with section-specific OG tags

### Previous Updates - October 30, 2025

#### UI/UX Improvements for Upload Containers and Preview Modal

**1. Preview Modal Close Button Repositioning**
- **Problem Fixed**: Close (X) button was centered in the preview modal header
- **Solution**: 
  - Updated `.preview-header` to use centered flexbox with `position: relative`
  - Positioned `.preview-close-btn` absolutely to the far right corner using `position: absolute; right: 20px`
  - Button remains vertically centered with `transform: translateY(-50%)`
- **Impact**: Cleaner, more standard modal layout with close button in the expected top-right corner position

**2. Upload Container Information Enhancement**
- **Added Information**: All 5 preset sections now display file upload guidelines
  - New text: "JPG, PNG, WEBP • Maximum 10 MB"
  - Styled with `.upload-file-info` class (subtle gray color, 12px font)
- **Affected Sections**: 
  - NSDL (Protean) Photograph
  - NSDL (Protean) Signature
  - UTI/ITSL Photograph
  - UTI/ITSL Signature
  - Custom Centimeter Resizer
- **Impact**: Users now have clear visibility of supported file types and size limits before uploading

**3. File Size Validation Implementation**
- **Feature**: 10 MB file size limit enforcement
- **Implementation**: 
  - Added validation in both `handleFileSelect()` (preset sections) and `handleCustomFileSelect()` (custom CM) functions
  - Checks `file.size > 10 * 1024 * 1024` before processing
  - Displays user-friendly alert message showing actual file size and limit
  - Returns early to prevent upload if file exceeds limit
- **User Experience**: Clear feedback when attempting to upload oversized files with specific size information

**4. Upload Button Text Refinement**
- **Changed**: Replaced "browse" text with "upload" across all upload containers
- **Affected Elements**: `.browse-text` span in all 5 preset sections
- **Rationale**: More action-oriented and clearer terminology for users

**5. Upload Label Cleanup**
- **Removed**: Redundant "Upload Image" label (`<p class="upload-label">`) from all upload containers
- **Impact**: Cleaner, less cluttered upload interface with streamlined visual hierarchy
- **Result**: Upload containers now show only icon, hint text, and file type/size information

**Technical Implementation**:
- Modified files:
  - `pan-resizer-theme/assets/css/main-style.css`: Preview modal positioning and upload file info styling
  - `pan-resizer-theme/template-parts/preset-resizers.php`: Updated all 5 upload container HTML structures
  - `pan-resizer-theme/assets/js/main-script.js`: Added file size validation logic

## User Preferences
Preferred communication style: Simple, everyday language (Bengali/Bangla and English).

## System Architecture

### Frontend Architecture
The application is built as a Single-Page Application (SPA) using vanilla JavaScript, focusing on client-side processing without external frameworks. It employs a mobile-first responsive design with breakpoint-based media queries and touch-optimized interactions. Performance is a key consideration, with optimizations such as critical rendering path optimization, lazy loading of non-critical resources, DNS prefetching, preconnect hints, and LCP element marking for Core Web Vitals.

### Image Processing Architecture
All image manipulation, including resizing, compression, rotation, zoom, brightness, contrast adjustments, and white background generation, occurs client-side using the HTML Canvas API. The tool supports various input formats and specific output requirements (e.g., 200x200px, 3.5x2.5cm, specific KB limits). PDF processing capabilities are integrated using `pdf-lib` and `jspdf` for document manipulation and PDF to JPG conversion. The compression algorithm utilizes a binary search approach to ensure output file sizes consistently reach 95-100% of the target size, improving image quality while staying within limits.

### WordPress Theme Architecture
The application is structured as a custom WordPress theme, converting the standalone HTML/CSS/JS into a WordPress-compatible template-based architecture. It adheres to WordPress theme standards, organizing assets in dedicated directories and utilizing modular template parts for reusability. The theme maintains all original functionality while integrating seamlessly into the WordPress ecosystem, including WordPress-specific SEO optimizations.

### UI Component Design
The interface includes an accordion-style FAQ component with ARIA-compliant accessibility attributes and keyboard navigation. The overall design emphasizes a clean, modern light theme with professional styling, including floating card headers, rounded corners, and consistent spacing. Dedicated preset sections for NSDL and UTI photographs and signatures, along with a custom centimeter resizer, provide tailored user experiences. UI improvements include optimized filename input containers, labels placed inside input boxes for custom CM resizer, and simplified filename input placeholders. The system also preserves original image quality across multiple resize operations by always drawing from the initial upload.

### SEO and Performance Optimization
The system incorporates advanced SEO features, including context-aware canonical URLs, comprehensive meta tags (description, keywords, author, robots), Open Graph and Twitter Card tags for social sharing, and JSON-LD structured data (WebApplication, FAQPage schemas). Performance optimizations include browser caching strategies, deferred script loading, critical CSS and JS preloading, asynchronous loading of non-critical resources, and DNS prefetching/preconnect for CDN resources.

## External Dependencies

### JavaScript Libraries
-   `jspdf`: For PDF generation.
-   `pdf-lib`: For reading and modifying PDF documents.
-   `@pdf-lib/standard-fonts`: Provides standard font support for PDF operations.
-   `@pdf-lib/upng`: Used for PNG compression within PDF contexts.
-   `pako`: A compression library utilized by PDF-related dependencies.
-   `@babel/runtime`: Babel runtime helpers.
-   `regenerator-runtime`: Provides runtime support for async/await.

### CDN Resources
-   **Font Awesome 6.4.0**: Icon library loaded asynchronously from `cdnjs.cloudflare.com`.

### External Services
-   **cdnjs.cloudflare.com**: Serves as the primary CDN for third-party libraries.