# PAN Card Resizer WordPress Theme

একটি পেশাদার WordPress থিম যা PAN Card Photo, Signature এবং Document Resizer Tool এর জন্য তৈরি করা হয়েছে।

## বৈশিষ্ট্য

- ✅ সম্পূর্ণ responsive design
- ✅ PAN Card photo, signature এবং document resize করার সুবিধা
- ✅ NSDL/UTI requirements অনুযায়ী optimize করা
- ✅ Client-side image processing (কোনো server upload নেই)
- ✅ PDF to JPG conversion support
- ✅ Advanced image editing (rotation, zoom, brightness, contrast)
- ✅ SEO optimized
- ✅ Fast loading এবং performance optimized

## Installation নির্দেশনা

### Method 1: WordPress Admin Panel দিয়ে

1. **থিম ZIP করুন:**
   ```bash
   zip -r pan-resizer-theme.zip pan-resizer-theme/
   ```

2. **WordPress Admin Panel এ যান:**
   - Dashboard → Appearance → Themes → Add New → Upload Theme
   - `pan-resizer-theme.zip` ফাইলটি select করুন
   - "Install Now" ক্লিক করুন
   - Installation complete হলে "Activate" ক্লিক করুন

### Method 2: FTP/cPanel দিয়ে

1. **থিম folder copy করুন:**
   - `pan-resizer-theme` folder টি আপনার WordPress installation এর `wp-content/themes/` directory তে copy করুন

2. **Activate করুন:**
   - WordPress Dashboard → Appearance → Themes
   - "PAN Card Resizer" থিম খুঁজুন এবং "Activate" করুন

## থিম Structure

```
pan-resizer-theme/
├── assets/
│   ├── css/
│   │   └── main-style.css    # Main stylesheet
│   ├── js/
│   │   └── main-script.js    # Main JavaScript
│   └── images/               # Theme images
├── template-parts/
│   └── pan-resizer-tool.php  # PAN resizer tool template
├── style.css                 # WordPress theme header
├── functions.php             # Theme functions
├── header.php                # Header template
├── footer.php                # Footer template
├── index.php                 # Main template
└── README.md                 # This file
```

## ব্যবহার নির্দেশনা

### Theme Activate করার পর:

1. **Homepage Setup:**
   - Pages → Add New
   - Title: "PAN Card Resizer" বা আপনার পছন্দ মত
   - Content এ যা ইচ্ছে লিখতে পারেন অথবা খালি রাখতে পারেন
   - Settings → Reading → "A static page" select করুন
   - Homepage: আপনার তৈরি page টি select করুন

2. **Menu Setup (Optional):**
   - Appearance → Menus
   - একটি নতুন menu তৈরি করুন
   - আপনার page গুলো add করুন
   - Menu Location: "Primary Menu" select করুন

## Customization

### Colors পরিবর্তন করতে:

`assets/css/main-style.css` file এ নিচের colors edit করুন:
- Header color: `#1e88e5`
- Button color: `#3b82f6`
- Background: `#f5f7f8`

### Logo যোগ করতে:

1. `assets/images/` folder এ আপনার logo যোগ করুন
2. `header.php` file edit করে `<h1>` tag এর জায়গায় logo image যোগ করুন

## Requirements

- WordPress 5.0 বা তার উপরের version
- PHP 7.4 বা তার উপরের version
- Modern web browser (Chrome, Firefox, Safari, Edge)

## Support

কোনো সমস্যা বা প্রশ্ন থাকলে theme documentation দেখুন অথবা WordPress support forum এ জিজ্ঞাসা করুন।

## License

GPL v2 or later

## Credits

- Font Awesome Icons
- PDF.js for PDF processing
- jsPDF for PDF generation

---

**Note:** এই থিমটি আপনার HTML website থেকে WordPress তে convert করা হয়েছে। সব functionality যেমন ছিল তেমনই কাজ করবে।
