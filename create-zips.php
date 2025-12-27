<?php
// Create ZIP files using PHP ZipArchive

function createThemeZip() {
    $zip = new ZipArchive();
    $filename = 'pan-resizer-theme.zip';
    
    if ($zip->open($filename, ZipArchive::CREATE) === TRUE) {
        // Add all files from pan-resizer-theme directory
        addDirToZip('pan-resizer-theme', $zip, 'pan-resizer-theme');
        $zip->close();
        echo "✅ Theme ZIP created: $filename\n";
        return true;
    }
    return false;
}

function createPluginZip() {
    $zip = new ZipArchive();
    $filename = 'pan-resizer-ads.zip';
    
    if ($zip->open($filename, ZipArchive::CREATE) === TRUE) {
        // Add all files from pan-resizer-ads directory
        addDirToZip('pan-resizer-ads', $zip, 'pan-resizer-ads');
        $zip->close();
        echo "✅ Plugin ZIP created: $filename\n";
        return true;
    }
    return false;
}

function addDirToZip($dir, &$zip, $zipPath = '') {
    $files = scandir($dir);
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        
        $filePath = $dir . '/' . $file;
        $archivePath = $zipPath ? $zipPath . '/' . $file : $file;
        
        if (is_dir($filePath)) {
            $zip->addEmptyDir($archivePath);
            addDirToZip($filePath, $zip, $archivePath);
        } else {
            $zip->addFile($filePath, $archivePath);
        }
    }
}

echo "Creating ZIP files...\n\n";

if (createThemeZip() && createPluginZip()) {
    echo "\n🎉 All ZIP files created successfully!\n";
    echo "\nFiles created:\n";
    echo "  1. pan-resizer-theme.zip\n";
    echo "  2. pan-resizer-ads.zip\n";
    echo "\nYou can now download them from Replit file manager.\n";
} else {
    echo "❌ Error creating ZIP files\n";
}
?>
