const fs = require('fs');
const archiver = require('archiver');
const path = require('path');

// Create output stream
const output = fs.createWriteStream('pan-resizer-theme-fixed.zip');
const archive = archiver('zip', {
  zlib: { level: 9 }
});

output.on('close', function() {
  console.log('ZIP created successfully!');
  console.log('Total bytes: ' + archive.pointer());
});

archive.on('error', function(err) {
  throw err;
});

// Pipe archive data to the file
archive.pipe(output);

// Add the theme directory
archive.directory('pan-resizer-theme/', false);

// Finalize the archive
archive.finalize();
