# Coding Standards — OLM Gutenberg Additions

> Reference document for plugin development

---

## 📐 Naming Conventions

### Classes
```php
Prefix: OLM_GA_*
Example: class OLM_GA_Block_Renderer { }
```

### PHP Functions
```php
Prefix: olm_ga_*
Example: function olm_ga_enqueue_assets() { }
```

### Handles (JS/CSS)
```text
Format: olm-ga-* (kebab-case)
Example: wp_enqueue_script('olm-ga-blocks', ...);
         wp_enqueue_style('olm-ga-editor', ...);
```

### CSS Selectors
```css
Format: .olm-ga-*
Example: .olm-ga-toolbar { }
         .olm-ga-toolbar__button { }
```

### Text Domain
```php
Domain: olm-gutenberg-additions
Example: __('String to translate', 'olm-gutenberg-additions');
```

---

## 🔧 Technical Configuration

| Language    | Standard                          | Notes                        |
| ----------- | --------------------------------- | ---------------------------- |
| PHP         | WordPress Coding Standards (WPCS) | PHPCS mandatory              |
| JavaScript  | ES6+ compatible                   | No transpilation required    |
| Namespaces  | None                              | Prefix-based naming instead  |
| Build       | None                              | No Node.js / npm required    |

---

## 🛡️ Security (to complete)

- Escape all outputs (`esc_html()`, `esc_attr()`, `wp_kses()`)
- Sanitize all inputs (`sanitize_text_field()`, `absint()`)
- Use nonces on forms and AJAX actions

---

## ℹ️ Documentation (to complete)

- DocBlocks for all public classes and functions
- JSDoc for complex JS functions
- Usage examples in critical files