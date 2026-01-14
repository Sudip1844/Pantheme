const fs = require("fs");
const archiver = require("archiver");
const path = require("path");

// Create a proper WordPress plugin ZIP
const output = fs.createWriteStream("pan-resizer-ads-fixed.zip");
const archive = archiver("zip", { zlib: { level: 9 } });

output.on("close", () => {
  console.log("✅ Fixed plugin ZIP created: pan-resizer-ads-fixed.zip");
  console.log("   Total bytes: " + archive.pointer());
  console.log("\n📦 Upload this file to WordPress!");
});

archive.on("error", (err) => {
  throw err;
});

archive.pipe(output);

// Add files with correct structure: pan-resizer-ads/file.php
const pluginDir = "pan-resizer-ads";
const files = fs.readdirSync(pluginDir);

files.forEach((file) => {
  const filePath = path.join(pluginDir, file);
  const stat = fs.statSync(filePath);

  if (stat.isFile()) {
    archive.file(filePath, { name: `pan-resizer-ads/${file}` });
    console.log(`Adding: pan-resizer-ads/${file}`);
  }
});

archive.finalize();
