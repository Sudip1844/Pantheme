# PAN Card Resizer - Online Image Tool

## Overview
PAN Card Resizer is a client-side web application designed to resize and compress PAN card photos, signatures, and documents to meet NSDL/UTI requirements. It operates entirely in the browser, ensuring user privacy and fast performance by processing images locally without server uploads. The application offers a comprehensive suite of tools for image manipulation, including custom centimeter resizing, and is available as both a standalone HTML site and a WordPress theme. Its primary purpose is to simplify compliance with official document submission standards for PAN cards, catering to a broad user base with an intuitive and efficient online tool. The project aims to be the go-to solution for PAN card image resizing, providing a secure, fast, and user-friendly experience.

## Recent Changes (October 28, 2025)

### Latest Updates - Image Preview & Download Enhancements
- **Fixed Canvas Rendering Bug**: Added hidden canvas elements to all 5 preset sections to resolve "Cannot read properties of null (reading 'getContext')" error
- **Improved Image Preview Flow**: Modified resizeImage() function to replace the uploaded preview image in-place instead of creating a new container
  - Resized image now appears in the SAME container where the original upload preview was shown
  - Eliminates visual clutter and maintains consistent layout
- **Custom Filename Support**: Added optional filename input field after resizing
  - Replaces the original image details display with a "File name (optional)" input box
  - Users can enter custom filename before downloading
  - If no custom name is provided, uses default format: `{sectionId}-{width}x{height}.jpg`
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