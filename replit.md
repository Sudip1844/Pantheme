# PAN Card Resizer - Online Image Tool

## Overview

PAN Card Resizer is a client-side web application designed to resize and compress PAN card photos, signatures, and documents according to NSDL/UTI requirements. The tool operates entirely in the browser, processing images locally without server uploads, ensuring user privacy and fast performance. The application is available both as a standalone HTML site and as a WordPress theme.

## User Preferences

Preferred communication style: Simple, everyday language.

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

**Dynamic Title Generation**
- JavaScript-based dynamic page title updates based on referring search terms
- Keyword rotation system with categorized title variations
- Multiple keyword categories for different use cases (photo resizing, signature compression, document conversion)
- Search engine optimization for PAN card-related queries

**Meta Tag Strategy**
- Comprehensive meta descriptions and keywords
- Structured data through meta tags
- Theme color and mobile app capability declarations
- Cache control headers for performance

### Caching and Performance

**Browser Caching Strategy**
- Long-term cache headers (max-age=31536000) for static assets
- Content encoding optimization (gzip)
- Public cache control for CDN compatibility
- DNS prefetching for external resources

**Resource Loading Strategy**
- Critical CSS and JS preloading
- Deferred loading of third-party resources (Font Awesome)
- Image fetch priority optimization (high priority for logo)
- Async/defer script loading patterns

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