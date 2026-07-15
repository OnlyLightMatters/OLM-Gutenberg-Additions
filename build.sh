#!/bin/bash

set -e

PLUGIN="olm-gutenberg-additions"
VERSION="0.3.0"

rm -rf build
mkdir -p build

rsync -av \
    --exclude=".git" \
    --exclude=".github" \
    --exclude=".gitattributes" \
    --exclude=".gitignore" \
    --exclude=".editorconfig" \
    --exclude="*.zip" \
    --exclude="VISION.md" \
    --exclude="build.sh" \
    --exclude="build" \
    --exclude="docs" \
    --exclude="tests" \
    ./build/$PLUGIN

cd build

zip -rq ${PLUGIN}-${VERSION}.zip $PLUGIN

cd ..

echo
echo "Package created:"
echo "build/${PLUGIN}-${VERSION}.zip"