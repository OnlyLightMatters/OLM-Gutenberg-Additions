#!/usr/bin/env bash

# Compile all .po files from ../languages into .mo files

set -e

if ! command -v msgfmt >/dev/null 2>&1; then
    echo "Error: msgfmt not found. Please install gettext."
    exit 1
fi

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PLUGIN_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"
LANG_DIR="$PLUGIN_ROOT/languages"

if [ ! -d "$LANG_DIR" ]; then
    echo "Error: languages directory not found: $LANG_DIR"
    exit 1
fi

echo "Compiling .po files from: $LANG_DIR"

count=0

for po_file in "$LANG_DIR"/*.po; do
    # Handle case where no .po file exists
    [ -e "$po_file" ] || continue

    mo_file="${po_file%.po}.mo"

    echo "  $po_file -> $mo_file"

    msgfmt "$po_file" -o "$mo_file"

    count=$((count + 1))
done

if [ "$count" -eq 0 ]; then
    echo "No .po files found in $LANG_DIR"
else
    echo "$count translation file(s) compiled successfully."
fi