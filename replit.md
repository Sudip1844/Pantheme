# PAN Card Resizer - Online Image Tool

## Overview

PAN Card Resizer is a client-side web application designed to resize and compress PAN card photos, signatures, and documents according to NSDL/UTI requirements. The tool operates entirely in the browser, processing images locally without server uploads, ensuring user privacy and fast performance. The application is available both as a standalone HTML site and as a WordPress theme.

## Recent Changes (October 17, 2025)

**UI/UX Updates:**
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