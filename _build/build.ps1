######################################################
# DONT WORK : ZIP not accepted by Wordpress
# filenames contain the relative path with "\\"
######################################################

$ErrorActionPreference = "Stop"

$PLUGIN = "olm-gutenberg-additions"
$PLUGIN_FILE = "$PLUGIN.php"

if (-not (Test-Path $PLUGIN_FILE)) {
    Write-Error "Error: $PLUGIN_FILE not found"
    exit 1
}

$content = Get-Content $PLUGIN_FILE -Raw

if ($content -match "define\(\s*'OLM_GA_VERSION'\s*,\s*'([^']+)'") {
    $VERSION = $matches[1]
} else {
    Write-Error "Error: OLM_GA_VERSION not found in $PLUGIN_FILE"
    exit 1
}

$BUILD_DIR = "build"
$PACKAGE_DIR = Join-Path $BUILD_DIR $PLUGIN

if (Test-Path $BUILD_DIR) {
    Remove-Item $BUILD_DIR -Recurse -Force
}

New-Item -ItemType Directory -Path $PACKAGE_DIR -Force | Out-Null

$excludes = @(
    ".git",
    ".github",
    ".gitignore",
    ".gitattributes",
    ".editorconfig",
    "olm-gutenberg-additions.sublime-project",
    "olm-gutenberg-additions.sublime-workspace",
    "VISION.md",
    "build.sh",
    "build.ps1",
    "build",
    "docs",
    "tests"
)

Get-ChildItem -Force | Where-Object {
    $excludes -notcontains $_.Name
} | ForEach-Object {
    Copy-Item $_.FullName -Destination $PACKAGE_DIR -Recurse -Force
}

$zipPath = Join-Path $BUILD_DIR "$PLUGIN-$VERSION.zip"

Add-Type -AssemblyName System.IO.Compression.FileSystem

if (Test-Path $zipPath) {
    Remove-Item $zipPath -Force
}

Push-Location $BUILD_DIR

Compress-Archive `
    -Path ".\$PLUGIN" `
    -DestinationPath ".\$PLUGIN-$VERSION.zip" `
    -CompressionLevel Optimal

Pop-Location

Write-Host ""
Write-Host "Package created:"
Write-Host $zipPath