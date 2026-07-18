# Release Process

This document describes the process for releasing a new version of the WordPress plugin.

The goal of this process is to ensure that every release is:
- documented;
- tested;
- properly versioned;
- packaged correctly;
- traceable through Git and GitHub.

---

## Release checklist

### 1. Update CHANGELOG

Update the `CHANGELOG.md` file with all changes included in the release.

Include:
- new features;
- bug fixes;
- breaking changes;
- important internal changes.

The changelog provides users and contributors with a clear overview of what changed between versions.

---

### 2. Update README

Review and update the `README.md` file when needed.

Update:
- installation instructions;
- configuration details;
- usage examples;
- screenshots or documentation that are no longer accurate.

The README is often the first point of contact for users and must remain aligned with the released version.

---

### 3. Update plugin version

Update all version references before creating the release.

Check version numbers in:
- the main plugin file header;
- plugin constants (if applicable);
- `readme.txt` (if publishing on WordPress.org);
- any other version-related files.

Keeping version numbers synchronized prevents inconsistencies between Git tags, WordPress metadata, and the packaged plugin.

---

### 4. Test on a clean WordPress installation

Install and test the plugin on a fresh WordPress environment.

Verify:
- plugin activation works;
- no PHP errors are introduced;
- core features work as expected;
- supported WordPress versions remain compatible;
- no required files are missing.

Testing on a clean installation helps detect issues that may be hidden by a development environment.

---

### 5. Generate ZIP package

Generate the distribution ZIP file.

The package should contain only the files required by users:

Include:
- plugin source files;
- required assets;
- translations;
- necessary documentation.

Exclude:
- development files;
- tests;
- local configuration files;
- temporary files.

The generated ZIP must be directly installable from the WordPress admin dashboard.

---

### 6. Merge `develop` → `main`

Merge the release branch or `develop` branch into `main`.

Before merging:
- ensure tests are passing;
- verify the version number;
- verify documentation is complete;
- confirm the changelog is ready.

The `main` branch represents the code state of published releases.

---

### 7. Create Git tag

Create an annotated Git tag for the release.
