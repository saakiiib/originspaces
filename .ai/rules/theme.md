---
paths:
  - 'resources/views/frontend/**'
---

# Theme

## Internal anchors require @spa
Every internal anchor must use the package directive (<a @spa href="...">), which compiles to data-spa for the engine. Never write raw data-spa. External links (http, mailto:, tel:) and # anchors must NOT have it, and file downloads must stay plain.
