#!/usr/bin/env node

const archiver = require('archiver');
const fs = require('fs');
const path = require('path');

// Create ZIP for theme
function createThemeZip() {
    return new Promise((resolve, reject) => {
        const output = fs.createWriteStream('pan-resizer-theme.zip');
        const archive = archiver('zip', { zlib: { level: 9 } });

        output.on('close', () => {
            console.log('✅ Theme ZIP created: pan-resizer-theme.zip (' + archive.pointer() + ' bytes)');
            resolve();
        });

        archive.on('error', reject);
        output.on('error', reject);

        archive.pipe(output);
        
        // Add the theme directory
        archive.directory('pan-resizer-theme/', 'pan-resizer-theme');
        
        archive.finalize();
    });
}

// Create ZIP for plugin
function createPluginZip() {
    return new Promise((resolve, reject) => {
        const output = fs.createWriteStream('pan-resizer-ads.zip');
        const archive = archiver('zip', { zlib: { level: 9 } });

        output.on('close', () => {
            console.log('✅ Plugin ZIP created: pan-resizer-ads.zip (' + archive.pointer() + ' bytes)');
            resolve();
        });

        archive.on('error', reject);
        output.on('error', reject);

        archive.pipe(output);
        
        // Add the plugin directory
        archive.directory('pan-resizer-ads/', 'pan-resizer-ads');
        
        archive.finalize();
    });
}

// Run both
async function createZips() {
    try {
        console.log('Creating ZIP files...\n');
        await createThemeZip();
        await createPluginZip();
        console.log('\n🎉 All ZIP files created successfully!');
        console.log('\nYou can now download:');
        console.log('  1. pan-resizer-theme.zip');
        console.log('  2. pan-resizer-ads.zip');
    } catch (error) {
        console.error('❌ Error:', error);
        process.exit(1);
    }
}

createZips();
