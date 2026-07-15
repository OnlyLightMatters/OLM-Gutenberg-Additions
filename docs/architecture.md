# Architecture

This document describes the overall architecture of **OLM Gutenberg Additions**.

Its purpose is to keep the project simple, modular and maintainable over time.

## Design principles

The plugin follows a modular architecture.

Each feature is implemented as an independent module responsible for its own PHP, JavaScript and CSS assets.

The plugin core is intentionally kept as small as possible.

## Directory structure

```text
olm-gutenberg-additions/

├── CHANGELOG.md
├── LICENSE
├── README.md
├── VISION.md
├── assets
│   ├── css
│   │   ├── editor.css
│   │   └── frontend.css
│   └── js
│       └── editor.js
├── build
│   ├── olm-gutenberg-additions
│   │   ├── CHANGELOG.md
│   │   ├── LICENSE
│   │   ├── README.md
│   │   ├── assets
│   │   │   ├── css
│   │   │   │   ├── editor.css
│   │   │   │   └── frontend.css
│   │   │   └── js
│   │   │       └── editor.js
│   │   ├── includes
│   │   │   └── class-olm-plugin.php
│   │   ├── languages
│   │   ├── modules
│   │   │   ├── cover
│   │   │   │   ├── class-olm-cover.php
│   │   │   │   ├── olm-cover.css
│   │   │   │   └── olm-cover.js
│   │   │   ├── document
│   │   │   │   ├── class-olm-document.php
│   │   │   │   ├── olm-document.css
│   │   │   │   └── olm-document.js
│   │   │   └── paragraph
│   │   │       ├── class-olm-paragraph.php
│   │   │       ├── olm-paragraph.css
│   │   │       └── olm-paragraph.js
│   │   ├── olm-gutenberg-additions.php
│   │   └── uninstall.php
│   └── olm-gutenberg-additions-0.2.0.zip
├── build.sh
├── docs
│   ├── architecture.md
│   ├── coding-standards.md
│   └── release-process.md
├── includes
│   └── class-olm-plugin.php
├── languages
├── modules
│   ├── cover
│   │   ├── class-olm-cover.php
│   │   ├── olm-cover.css
│   │   └── olm-cover.js
│   ├── document
│   │   ├── class-olm-document.php
│   │   ├── olm-document.css
│   │   └── olm-document.js
│   └── paragraph
│       ├── class-olm-paragraph.php
│       ├── olm-paragraph.css
│       └── olm-paragraph.js
├── olm-gutenberg-additions.php
├── tests
└── uninstall.php
```

## Bootstrap

The plugin entry point is:

```text
olm-gutenberg-additions.php
```

Its responsibilities are limited to:

* defining plugin constants;
* loading the main plugin class;
* starting the plugin.

Business logic must never be implemented here.

## Plugin core

The plugin core is implemented in:

```text
includes/class-olm-plugin.php
```

Its responsibilities are:

* initialize the plugin;
* load modules;
* register shared assets;
* initialize shared services.

It should remain lightweight.

## Modules

Each feature lives in its own directory.

Example:

```text
modules/

    paragraph/

        class-olm-paragraph.php

        olm-paragraph.js

        olm-paragraph.css
```

Every module owns its implementation.

Whenever possible, modules should not depend on one another.

## Shared assets

Global editor assets belong to:

```text
assets/
```

Module-specific assets belong inside their respective module directory.

## Coding philosophy

Each source file should have a single responsibility.

Classes should remain focused and easy to understand.

Code readability is preferred over clever implementations.

## Future evolution

The architecture is designed to support:

* optional modules;
* settings page;
* internationalization;
* additional editor enhancements.

New features should follow the same modular organization rather than extending existing modules whenever possible.
