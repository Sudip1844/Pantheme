const fs = require("fs");
const archiver = require("archiver");
const path = require("path");

console.log("🎨 Creating WordPress Theme ZIP...\n");

// Create theme ZIP
const themeOutput = fs.createWriteStream("pan-resizer-theme.zip");
const themeArchive = archiver("zip", { zlib: { level: 9 } });

themeOutput.on("close", () => {
  console.log("✅ Theme ZIP created: pan-resizer-theme.zip");
  console.log("   Total bytes: " + themeArchive.pointer());
});

themeArchive.on("error", (err) => {
  throw err;
});

themeArchive.pipe(themeOutput);

// Add theme files with correct structure: pan-resizer-theme/
const themeDir = "pan-resizer-theme";

// Recursively add all files
function addFilesRecursively(dir, baseDir) {
  const files = fs.readdirSync(dir);

  files.forEach((file) => {
    const filePath = path.join(dir, file);
    const stat = fs.statSync(filePath);
    const relativePath = path.relative(baseDir, filePath);

    if (stat.isDirectory()) {
      // Recursively add directory contents
      addFilesRecursively(filePath, baseDir);
    } else if (stat.isFile()) {
      // Add file with proper path structure
      const archivePath = path.join("pan-resizer-theme", relativePath).replace(/\\/g, '/');
      themeArchive.file(filePath, { name: archivePath });
      console.log(`  Adding: ${archivePath}`);
    }
  });
}

addFilesRecursively(themeDir, themeDir);

themeArchive.finalize();
