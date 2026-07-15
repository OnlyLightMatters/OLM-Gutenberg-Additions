# ------------------------------------------------------------
#  build.ps1 – version PowerShell du script Bash
# ------------------------------------------------------------

# Arrêt immédiat à la première erreur (équivalent de `set -e`)
$ErrorActionPreference = 'Stop'

# -------------------   Variables   -------------------------
$PLUGIN  = 'olm-gutenberg-additions'
$VERSION = '0.3.0'

# Répertoire racine du script (où se trouve build.ps1)
$RootDir = $PSScriptRoot

# Répertoire de travail « build »
$BuildDir = Join-Path -Path $RootDir -ChildPath 'build'

# ----------------------------------------------------------------
# 1️⃣  Nettoyage du répertoire build
# ----------------------------------------------------------------
if (Test-Path $BuildDir) {
    Remove-Item -Path $BuildDir -Recurse -Force -ErrorAction SilentlyContinue
}
New-Item -Path $BuildDir -ItemType Directory | Out-Null

# ----------------------------------------------------------------
# 2️⃣  Copie sélective du plugin dans le répertoire build
# ----------------------------------------------------------------
$SourceDir = Join-Path -Path $RootDir -ChildPath "build\$PLUGIN"
$DestDir   = Join-Path -Path $BuildDir -ChildPath $PLUGIN

# Patterns à exclure (même logique que les `--exclude` de rsync)
$ExcludePatterns = @(
    '.git',
    '.github',
    '.gitattributes',
    '.gitignore',
    '.editorconfig',
    '*.zip',
    'build.sh',
    'build',
    'tests'
)

# Crée le dossier de destination
New-Item -Path $DestDir -ItemType Directory -Force | Out-Null

# Copie tout en filtrant les exclusions
Get-ChildItem -Path $SourceDir -Recurse -Force |
    Where-Object {
        $keep = $true
        foreach ($pat in $ExcludePatterns) {
            if ($_.FullName -like "*$pat*") { $keep = $false; break }
        }
        $keep
    } |
    ForEach-Object {
        $relative = $_.FullName.Substring($SourceDir.Length).TrimStart('\')
        $target   = Join-Path -Path $DestDir -ChildPath $relative

        if ($_.PSIsContainer) {
            # Crée le sous‑dossier si besoin
            if (-not (Test-Path $target)) {
                New-Item -Path $target -ItemType Directory | Out-Null
            }
        }
        else {
            # Copie le fichier
            Copy-Item -Path $_.FullName -Destination $target -Force
        }
    }

# ----------------------------------------------------------------
# 3️⃣  Création de l’archive ZIP
# ----------------------------------------------------------------
$ZipName   = "$PLUGIN-$VERSION.zip"
$ZipPath   = Join-Path -Path $BuildDir -ChildPath $ZipName

# `Compress-Archive` prend le chemin complet du dossier à zipper
Compress-Archive -Path $DestDir -DestinationPath $ZipPath -Force

# ----------------------------------------------------------------
# 4️⃣  Affichage du résultat
# ----------------------------------------------------------------
Write-Host "`nPackage created:"
Write-Host "build/$ZipName"