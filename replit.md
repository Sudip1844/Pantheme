# PAN Card Resizer - Online Image Tool

## Overview

PAN Card Resizer is a client-side web application designed to resize and compress PAN card photos, signatures, and documents according to NSDL/UTI requirements. The tool operates entirely in the browser, processing images locally without server uploads, ensuring user privacy and fast performance. The application is available both as a standalone HTML site and as a WordPress theme.

## Recent Changes (October 26, 2025)

**LATEST: Light Theme Applied to Preset Sections (Today)**
- **FIXED: Preset Section Styling** - Applied clean light theme to all preset resizer sections (NSDL Photo, NSDL Signature, UTI Photo, UTI Signature)
- **White Card Background** - Cards now use clean white background (#ffffff) with light gray borders (#e5e7eb)
- **Light Upload Areas** - Dashed gray borders (#d1d5db) with light background (#f9fafb) for clean appearance
- **Light Controls Panel** - DPI controls and calculated info with light gray background (#f9fafb) for better readability
- **Light Preview Containers** - Clean preview areas with dashed borders matching the overall light aesthetic
- **Color Adjustments** - Title colors (#6366f1 for NSDL, #8b5cf6 for UTI), gray text colors for optimal readability
- **Icon & Button Styling** - Upload icons in gray tones, purple gradient buttons maintained for actions
- Preset sections now use professional light theme matching modern web design standards

**NEW: Preset Resizer Sections**
- **ADDED: NSDL (Protean) Photograph Section** - Resize photos to 3.5cm x 2.5cm at 200 DPI, max 20 KB with adjustable DPI
- **ADDED: NSDL (Protean) Signature Section** - Resize signatures to 2cm x 4.5cm at 200 DPI, max 10 KB with adjustable DPI
- **ADDED: UTI/ITSL (UTI) Photograph Section** - Fixed 213x213 pixels at 300 DPI, max 30 KB
- **ADDED: UTI/ITSL (UTI) Signature Section** - Fixed 400x200 pixels at 600 DPI, max 60 KB
- **NEW: Template File** - Created preset-resizers.php with all 4 preset sections
- **NEW: CSS Styling** - Added comprehensive styling for preset cards, upload areas, preview containers, and responsive design
- **NEW: JavaScript Functionality** - Implemented drag & drop upload, DPI calculations, image resize with canvas, compression to target size, and download functionality
- **UPDATED: Navigation** - Added anchor links to all preset sections in mobile menu and footer (NSDL Photo, NSDL Sign, UTI Photo, UTI Sign)
- **INTEGRATED: Layout** - Preset sections placed between main editor and specifications section for better user flow
- All preset sections feature independent upload, resize, and preview functionality

**Files Modified:**
- `pan-resizer-theme/template-parts/preset-resizers.php` - New template with 4 preset sections (FIXED: Image upload now working with proper label-for-input binding)
- `pan-resizer-theme/assets/css/main-style.css` - Applied dark theme to preset sections with gradient backgrounds, updated colors for better contrast
- `pan-resizer-theme/assets/js/main-script.js` - Added ~290 lines of preset functionality with proper DOM ready handling
- `index.php` - Integrated preset sections and updated navigation

**Technical Implementation:**
- Upload boxes now use `<label for="fileInput-...">` tags for reliable click handling
- File inputs hidden with `display: none` to avoid z-index and pointer-events conflicts
- JavaScript initialization wrapped with readiness check for deferred script loading
- All resize buttons disabled by default until image is uploaded
- Dark theme colors chosen for optimal contrast and readability

## Recent Changes (October 18, 2025)

**WordPress Theme Critical Fixes:**
- **FIXED: Double Header Issue** - Removed duplicate HTML structure from index.php that was causing two headers to appear when theme was activated
- **FIXED: Menu Button Functionality** - Updated header.php to include share button and proper anchor navigation menu structure
- **FIXED: Upload Icon Not Loading** - Replaced image reference with inline SVG (purple-to-blue gradient with white arrow and yellow dot)
- **FIXED: FAQ Toggle Not Working** - Verified and corrected FAQ markup structure to match JavaScript expectations
- **FIXED: Duplicate Main Element** - Corrected HTML structure to have single `<main id="main-content">` wrapper for valid, accessible markup
- All fixes reviewed and verified by architect agent
- Theme now fully functional with all interactive elements working correctly

**Files Modified:**
- `pan-resizer-theme/index.php` - Removed duplicate HTML, proper main element structure
- `pan-resizer-theme/header.php` - Added share button, fixed menu structure
- `pan-resizer-theme/footer.php` - Updated to anchor navigation
- `pan-resizer-theme/template-parts/pan-resizer-editor.php` - Inline SVG upload icon

## Recent Changes (October 17, 2025)

**WordPress Theme Package:**
- **Created WordPress-ready theme zip** - pan-resizer-theme-wordpress.zip (619 KB) ready for WordPress installation
- **Fixed missing index.php** - Added required index.php template file for WordPress theme compatibility
- Theme now includes all necessary files: style.css, index.php, functions.php, header.php, footer.php, page.php, single.php

## Recent Changes

**UI/UX Updates:**
- **NEW: Modern Upload Icon** - Replaced SVG upload icon with a custom-designed gradient icon featuring a purple-to-blue gradient background, white upward arrow, and yellow-orange accent dot
- **FIXED: FAQ Toggle Functionality** - FAQ accordion now works correctly by wrapping initialization in DOMContentLoaded event
- **FIXED: FAQ Answer Display** - Changed JavaScript max-height to 1000px (from scrollHeight calculation) and CSS to 'none' to ensure all FAQ content is fully visible without clipping
- Moved "Our Other Tool" link from footer to a dedicated section below Privacy Policy
- New section titled "Our Other Tool" with "QR Code Generator & Scanner" hyperlink to https://myqrcodetool.com/
- Footer now contains navigation links (Home, Specifications, Features, How to Use, FAQ, Privacy Policy)
- Added 6 new FAQ items:
  1. Which file formats are supported?
  2. Is there a maximum file size limit?
  3. Is my data safe? Do you store my files?
  4. How long does it take to resize a photo?
  5. Which browsers are compatible with this tool?
  6. Can I resize multiple photos at once?

**SEO Enhancements:**
- Comprehensive meta tags (description, keywords, author, robots)
- Open Graph tags for social sharing (Facebook, LinkedIn)
- Twitter Card meta tags for Twitter sharing
- Structured data (JSON-LD) for WebApplication and FAQPage schemas
- Context-aware canonical URLs using wp_get_canonical_url()
- Improved title tags with keyword optimization

**Performance Optimizations:**
- Cache control headers (max-age=3600) for both standalone and WordPress versions
- Deferred script loading for better page load performance
- DNS prefetch and preconnect for CDN resources
- Resource preloading for critical CSS and JavaScript

## User Preferences

Preferred communication style: Simple, everyday language (Bengali/Bangla and English).

## System Architecture

### Frontend Architecture

**Single-Page Application (SPA) Design**
- The application uses vanilla JavaScript with no frontend framework dependencies
- All UI interactions and image processing happen client-side in the browser
- DOM manipulation is handled through native JavaScript APIs
- Event listeners use passive event handling for improved scroll and touch performance

**Performance Optimization Strategy**
- Critical rendering path optimization with resource preloading (CSS, JS, logo image)
- Lazy loading of non-critical resources (Font Awesome icons) using `requestIdleCallback`
- DNS prefetching and preconnect hints for third-party CDN resources
- Content visibility and containment CSS properties for improved rendering performance
- LCP (Largest Contentful Paint) element marking for Core Web Vitals optimization

**Responsive Design Approach**
- Mobile-first responsive design with viewport meta tags
- Breakpoint-based media queries for different screen sizes (768px, 480px)
- Touch-optimized interface with passive touch event listeners
- Viewport-fit=cover for safe area handling on notched devices

### Image Processing Architecture

**Client-Side Processing**
- Browser-based image manipulation using Canvas API (implied by the photo resizer functionality)
- No server-side processing or image uploads required
- Image compression and resizing performed entirely in JavaScript
- Support for multiple input formats with conversion capabilities

**PDF Processing Integration**
- Uses `pdf-lib` (v1.17.1) for PDF document manipulation
- Uses `jspdf` (v3.0.0) for PDF generation capabilities
- PDF to JPG conversion support for document processing
- Standard fonts handling through `@pdf-lib/standard-fonts`

**Image Editing Capabilities**
- Rotation, zoom, brightness, and contrast adjustments
- White background generation for biometric photos
- Size optimization to meet specific requirements (200x200px, 3.5x2.5cm formats)
- File size compression to meet limits (e.g., 50KB)

### WordPress Theme Architecture

**Theme Structure**
- Custom WordPress theme built from the standalone HTML application
- Template-based architecture using WordPress template hierarchy
- Asset organization: separate CSS and JS files in `assets/` directory
- Modular template parts for reusable components

**Theme Integration Approach**
- Standalone HTML/CSS/JS converted to WordPress-compatible structure
- WordPress theme standards compliance (style.css header, proper directory structure)
- Maintains all original functionality while integrating with WordPress ecosystem
- SEO optimization preserved in WordPress context

### UI Component Design

**FAQ Component**
- Accordion-style collapsible FAQ items
- ARIA-compliant accessibility attributes (aria-expanded, role="button")
- Keyboard navigation support with tabindex
- Unique ID generation for question-answer pairs
- Progressive enhancement approach

**Accessibility Features**
- Semantic HTML structure with proper heading hierarchy (H1, H2)
- ARIA attributes for interactive components
- Keyboard navigation support
- Focus management for interactive elements
- Screen reader compatibility

### SEO Optimization Strategy

**Advanced SEO Implementation**
- Context-aware canonical URLs using WordPress's wp_get_canonical_url()
- Comprehensive meta tags: description, keywords, author, robots directives
- Open Graph protocol tags for social media sharing (Facebook, LinkedIn)
- Twitter Card meta tags for enhanced Twitter sharing
- Structured data (JSON-LD) schemas:
  - WebApplication schema with feature list and pricing
  - FAQPage schema for rich snippets in search results
- Dynamic page-specific URLs for OG and Twitter cards
- Keyword-optimized meta descriptions targeting PAN card related searches

**Meta Tag Strategy**
- Comprehensive meta descriptions and keywords
- Structured data through JSON-LD schemas
- Theme color and mobile app capability declarations
- Cache control headers for performance (max-age=3600)

### Caching and Performance

**Browser Caching Strategy**
- HTML page cache headers (max-age=3600, must-revalidate) via template_redirect hook
- Static asset cache headers for long-term caching
- Content encoding optimization (gzip)
- Public cache control for CDN compatibility
- DNS prefetching for external resources

**Resource Loading Strategy**
- Critical CSS and JS preloading
- Deferred script loading for improved initial page load
- Font Awesome loaded asynchronously
- Image fetch priority optimization (high priority for logo)
- DNS prefetch and preconnect for CDN resources (cdnjs.cloudflare.com)

## External Dependencies

### JavaScript Libraries

**PDF Processing**
- `jspdf` (v3.0.0) - PDF generation library for creating PDF documents
- `pdf-lib` (v1.17.1) - PDF manipulation library for reading and modifying PDFs
- `@pdf-lib/standard-fonts` (v1.0.0) - Standard font support for PDF operations
- `@pdf-lib/upng` (v1.0.1) - PNG compression for PDF images
- `pako` (v1.0.x) - Compression library used by PDF libraries

**Utility Libraries**
- `@babel/runtime` (v7.26.10) - Babel runtime helpers for transpiled code
- `regenerator-runtime` (v0.14.0) - Runtime support for async/await and generators
- `@types/raf` (v3.4.3) - TypeScript definitions for requestAnimationFrame

### CDN Resources

**Font and Icon Libraries**
- Font Awesome 6.4.0 - Icon library loaded from cdnjs.cloudflare.com
- Loaded asynchronously to avoid blocking initial render

### External Services

**DNS and CDN**
- cdnjs.cloudflare.com - Primary CDN for third-party libraries (Font Awesome)
- DNS prefetch configured for performance optimization
- Preconnect hints for faster resource loading

### Development Environment

**Package Management**
- npm-based dependency management
- No build process or bundler configured (vanilla JavaScript approach)
- Direct browser execution of JavaScript files

### Browser APIs Used

**Core Web APIs**
- Canvas API (for image processing)
- File API (for image upload and processing)
- requestIdleCallback (for non-critical resource loading)
- Intersection Observer (implied by content-visibility usage)
- Service Workers or Cache API (implied by performance optimization focus)