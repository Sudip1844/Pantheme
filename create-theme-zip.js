const fs = require('fs');
const archiver = require('archiver');
const path = require('path');

const output = fs.createWriteStream('pan-resizer-theme.zip');
const archive = archiver('zip', {
  zlib: { level: 9 }
});

output.on('close', function() {
  console.log('✓ ZIP file created successfully!');
  console.log('  File: pan-resizer-theme.zip');
  console.log('  Size: ' + (archive.pointer() / 1024 / 1024).toFixed(2) + ' MB');
  console.log('  Total files: ' + archive.pointer() + ' bytes');
});

archive.on('error', function(err) {
  throw err;
});

archive.pipe(output);

archive.directory('pan-resizer-theme/', false);

archive.finalize();
