=== Claude Alt Text ===
Generate descriptive, SEO-friendly alt text for images using Claude's vision model.

== What it does ==
* Adds an "Alt text" column to the Media Library (list view) with a one-click Generate / Regenerate button per image.
* Adds a bulk tool at Media -> Generate Alt Text that lists every image missing alt text and fills them in with a single "Generate all" pass (with live progress).
* Saves results to WordPress's native alt-text field (_wp_attachment_image_alt), so Yoast, Rank Math, themes, and screen readers all pick it up automatically.

== Install ==
1. Zip the `claude-alt-text` folder (or use the provided .zip).
2. WP Admin -> Plugins -> Add New -> Upload Plugin -> choose the zip -> Install -> Activate.
3. Settings -> Claude Alt Text -> paste your Anthropic API key (from console.anthropic.com), pick a model, Save.

== Use ==
* Single image: Media Library in list view -> click Generate in the Alt text column.
* Bulk: Media -> Generate Alt Text -> Generate all below.

== Notes ==
* Uses the user's own Anthropic API key, stored in the site database and sent only to api.anthropic.com.
* Default model is Haiku 4.5 — fast and cheap, ideal for bulk runs. Switch to Sonnet/Opus in settings for richer descriptions.
* Supports JPEG, PNG, GIF, WEBP. SVGs are skipped (not supported by the vision API).
* The instruction prompt is editable in settings — tune length/tone, but keep "return only the alt text".
* Costs are per image; a 1,000-image run on Haiku is inexpensive but not free — check current API pricing.

== Hackathon stretch ideas ==
* Add a "context" input (target keyword / page topic) passed into the prompt for more on-topic alt text.
* Queue large runs via WP-Cron instead of the browser loop, so 5,000+ images don't depend on a tab staying open.
* Log a before/after report (images fixed, avg length) for the demo.
* Second mode: rewrite weak existing alt text, not just fill blanks.
