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
    --exclude="build.sh" \
    --exclude="build" \
    --exclude="tests" \
    ./build/$PLUGIN

cd build

zip -rq ${PLUGIN}-${VERSION}.zip $PLUGIN

echo
echo "Package created:"
echo "build/${PLUGIN}-${VERSION}.zip"
