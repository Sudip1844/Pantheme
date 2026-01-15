const fs = require("fs");
const archiver = require("archiver");
const path = require("path");

console.log("🔧 Creating WordPress Plugin ZIP...\n");

// Create plugin ZIP
const pluginOutput = fs.createWriteStream("pan-resizer-ads.zip");
const pluginArchive = archiver("zip", { zlib: { level: 9 } });

pluginOutput.on("close", () => {
  console.log("✅ Plugin ZIP created: pan-resizer-ads.zip");
  console.log("   Total bytes: " + pluginArchive.pointer());
});

pluginArchive.on("error", (err) => {
  throw err;
});

pluginArchive.pipe(pluginOutput);

// Add plugin files with correct structure: pan-resizer-ads/file.php
const pluginDir = "pan-resizer-ads";
const pluginFiles = fs.readdirSync(pluginDir);

pluginFiles.forEach((file) => {
  const filePath = path.join(pluginDir, file);
  const stat = fs.statSync(filePath);

  if (stat.isFile()) {
    pluginArchive.file(filePath, { name: `pan-resizer-ads/${file}` });
    console.log(`  Adding: pan-resizer-ads/${file}`);
  }
});

pluginArchive.finalize();
