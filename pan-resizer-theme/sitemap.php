<?php
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo home_url('/'); ?></loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    
    <?php 
    $sections = array('nsdl-photo', 'nsdl-signature', 'uti-photo', 'uti-signature', 'custom-cm-resizer', 'pan-card-editor', 'specifications', 'features', 'how-to-use', 'faq', 'privacy');
    foreach ($sections as $section) : ?>
    <url>
        <loc><?php echo home_url('/' . $section . '/'); ?></loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
</urlset>
