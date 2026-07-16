# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and this project adheres to [Semantic Versioning](https://semver.org/).

## [Unreleased]

### Added

* New modular architecture for editor enhancements.
* First dedicated module: **Paragraph**.
* Restored **Justify** alignment button for the Paragraph block.
* Paragraph module assets moved from the active theme to the plugin.

### Changed

* Refactored the plugin bootstrap to initialize independent feature modules.
* Prepared the plugin for future module activation and configuration.

---

## [0.3.1] - Edgard Varèse - 2026-07-16

### Name origin
* Named after Edgard Varèse, a foundational figure in the evolution from traditional composition toward sound as structure, texture, and spatial energy.

### Changed
* Prepares the i18n plugin infrastructure.

---

## [0.3.0] - Ferruccio Busoni - 2026-07-15

### Name origin
* Ferruccio Busoni brought one of the earliest visions of a future music freed from traditional constraints and open to new sound possibilities.

### Added

* Introduced the first modular feature architecture.
* Added the Paragraph module with justify alignment support.
* Restored the Justify alignment button to the Paragraph block toolbar.
* Selected Paragraph blocks in the Gutenberg editor are now justified on the frontend.

### Changed
* Refactored the plugin bootstrap to load independent feature modules.
* Moved editor assets from global loading to module-specific loading.
* Adopted consistent OLM naming conventions across classes, files and asset handles.

---

## [0.2.0] - 2026-07-14

### Added

* Initial plugin bootstrap.
* Plugin activation and asset loading.
* Editor JavaScript and CSS loading.
* Frontend CSS loading.
* Build script for generating distributable ZIP packages.
* Initial project structure for future modules.

---

## [0.1.0] - 2026-07-14

### Added

* Initial project architecture.
* GitHub repository.
* Plugin directory structure.
* Basic project files (`README.md`, `LICENSE`, `CHANGELOG.md`, `uninstall.php`).
* Plugin bootstrap and version constants.
