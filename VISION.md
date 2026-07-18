# Vision

## Why this project exists

OLM Gutenberg Additions was originally created to meet the author's own needs while building websites with the WordPress Block Editor.

Some useful editor capabilities disappeared over time or were abandoned by their original plugins. Rather than relying on unmaintained code, the project aims to provide modern, lightweight replacements based on current WordPress APIs.

If these improvements prove useful to others, the project is developed in the open so that anyone can benefit from them and contribute.

## Principles

The project follows a few fundamental principles.

### Native first

Whenever possible, use WordPress core APIs instead of introducing custom frameworks or external dependencies.

### Keep it lightweight

Every feature should justify its existence.

Small, focused modules are preferred over large collections of unrelated functionality.

### Modular architecture

Each enhancement lives in its own independent module.

Modules should be easy to understand, maintain and eventually enable or disable individually.

### Long-term maintainability

Readable code is more valuable than clever code.

The project favors simplicity, consistency and documentation over unnecessary complexity.

### Open source first

The project is developed in public and welcomes contributions from the community.

Code quality, documentation and transparency are considered essential parts of the project.

## What this project is not

OLM Gutenberg Additions is **not** intended to become another all-in-one editor extension.

Features will only be added when they solve a real editing problem while remaining consistent with the project's philosophy.

## Success

Success is not measured by downloads or popularity.
Success is achieved when the plugin remains useful, reliable and enjoyable to maintain, while helping other users who may share the same needs.

_I built it because I needed it. I share it because it may help others._

## Post title visual feedback

A visual indication (for example reducing the title opacity in the editor when "Hide title on frontend" is enabled) was considered during the development of v0.4.0.

This feature has deliberately not been implemented.

### Rationale

Since WordPress 7.0, the document title is no longer exposed as a standard Gutenberg block. It is rendered internally by the `PostTitle` React component (`packages/editor/src/components/post-title`) and inserted directly by the `VisualEditor` component.

At the time of writing, Gutenberg does not expose any official extension point (hook, filter, SlotFill or public API) allowing plugins to alter the rendering or styling of this component.

Implementing this behaviour would require manipulating Gutenberg's internal DOM or relying on undocumented React internals. This project deliberately avoids such approaches to remain lightweight, stable and compatible with future WordPress releases.

### Future

This feature may be revisited if Gutenberg exposes an official API allowing plugins to customize the editor rendering of the document title.
