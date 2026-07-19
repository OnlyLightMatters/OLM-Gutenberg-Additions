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


DIST_DIR="_dist"
PACKAGE_DIR="${DIST_DIR}/${PLUGIN}"

rm -rf "${DIST_DIR}"
mkdir -p "${PACKAGE_DIR}"

rsync -av \
    --exclude=".git" \
    --exclude=".github" \
    --exclude=".gitignore" \
    --exclude=".gitattributes" \
    --exclude=".editorconfig" \
    --exclude="VISION.md" \
    --exclude="_build" \
    --exclude="_dist" \
    --exclude="_tests" \
    --exclude="_docs" \
    --exclude="languages/*.pot" \
    --exclude="languages/*.po" \
    ./ "${PACKAGE_DIR}/"

cd "${DIST_DIR}"

zip -r "${PLUGIN}-${VERSION}.zip" "${PLUGIN}"

cd ..

echo
echo "Package created:"
echo "${DIST_DIR}/${PLUGIN}-${VERSION}.zip"