# PAN Card Resizer - Online Image Tool

## Overview
PAN Card Resizer is a client-side web application for resizing and compressing PAN card photos, signatures, and documents to meet NSDL/UTI requirements. It processes images locally in the browser, ensuring user privacy and fast performance. The application offers tools like custom centimeter resizing and comprehensive image manipulation, aiming to simplify compliance with official PAN card submission standards. It is available as both a standalone HTML site and a WordPress theme, striving to be a secure, fast, and user-friendly solution for PAN card image resizing.

## User Preferences
Preferred communication style: Simple, everyday language (Bengali/Bangla and English).

## System Architecture

### Frontend Architecture
The application is a Single-Page Application (SPA) built with vanilla JavaScript, focusing on client-side processing. It features a mobile-first, responsive design with breakpoint-based media queries and touch-optimized interactions. Performance optimizations include critical rendering path optimization, lazy loading, DNS prefetching, preconnect hints, and LCP element marking for Core Web Vitals.

### Image Processing Architecture
All image manipulation, such as resizing, compression, rotation, zoom, brightness, contrast adjustments, and white background generation, is performed client-side using the HTML Canvas API. It supports various input formats and specific output requirements (e.g., 200x200px, 3.5x2.5cm, specific KB limits). PDF processing, including document manipulation and PDF to JPG conversion, is integrated. The compression algorithm uses a binary search to achieve 95-100% of target file sizes while maintaining image quality.

### WordPress Theme Architecture
The application is structured as a custom WordPress theme, converting the standalone HTML/CSS/JS into a WordPress-compatible, template-based architecture. It adheres to WordPress theme standards, utilizing modular template parts and integrating seamlessly into the WordPress ecosystem, including WordPress-specific SEO optimizations.

### UI Component Design
The interface features an accordion-style FAQ component with ARIA-compliant accessibility. The design emphasizes a clean, modern light theme with professional styling, including floating card headers and rounded corners. Dedicated preset sections for NSDL and UTI photographs and signatures, plus a custom centimeter resizer, provide tailored user experiences. UI improvements include optimized filename input containers and simplified filename input placeholders. The system preserves original image quality across multiple resize operations.

### SEO and Performance Optimization
The system incorporates advanced SEO features, including context-aware canonical URLs, comprehensive meta tags (description, keywords, author, robots), Open Graph and Twitter Card tags for social sharing, and JSON-LD structured data (WebApplication, FAQPage schemas). Performance optimizations include browser caching strategies, deferred script loading, critical CSS and JS preloading, asynchronous resource loading, and DNS prefetching/preconnect for CDN resources.

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
-   **Font Awesome 6.4.0**: Icon library loaded asynchronously.

### External Services
-   **cdnjs.cloudflare.com**: Primary CDN for third-party libraries.