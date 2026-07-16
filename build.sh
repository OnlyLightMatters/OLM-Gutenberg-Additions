#!/bin/bash

set -e

PLUGIN="olm-gutenberg-additions"

PLUGIN_FILE="${PLUGIN}.php"

if [ ! -f "${PLUGIN_FILE}" ]; then
    echo "Error: ${PLUGIN_FILE} not found"
    exit 1
fi

VERSION=$(grep "define( *'OLM_GA_VERSION'" "${PLUGIN_FILE}" | sed -E "s/.*define\( *'OLM_GA_VERSION', *'([^']+)'.*/\1/")

if [ -z "${VERSION}" ]; then
    echo "Error: OLM_GA_VERSION not found in ${PLUGIN_FILE}"
    exit 1
fi


BUILD_DIR="build"
PACKAGE_DIR="${BUILD_DIR}/${PLUGIN}"

rm -rf "${BUILD_DIR}"
mkdir -p "${PACKAGE_DIR}"

rsync -av \
    --exclude=".git" \
    --exclude=".github" \
    --exclude=".gitignore" \
    --exclude=".gitattributes" \
    --exclude=".editorconfig" \
    --exclude="olm-gutenberg-additions.sublime-project" \
    --exclude="olm-gutenberg-additions.sublime-workspace" \
    --exclude="VISION.md" \
    --exclude="build.sh" \
    --exclude="build.ps1" \
    --exclude="build" \
    --exclude="docs" \
    --exclude="tests" \
    ./ "${PACKAGE_DIR}/"

cd "${BUILD_DIR}"

zip -r "${PLUGIN}-${VERSION}.zip" "${PLUGIN}"

cd ..

echo
echo "Package created:"
echo "${BUILD_DIR}/${PLUGIN}-${VERSION}.zip"