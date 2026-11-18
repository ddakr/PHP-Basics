# Copilot instructions for this repository

## Project shape
- This repo is a small PHP/HTML exercise, not a framework app. The working UI lives under `spsMarekPacl/ukol/`.
- `index.html` is the page shell and currently renders a BMW model gallery with static cards and images.
- `stylesheet.css` contains the page layout styles; keep CSS simple and direct instead of introducing a build system or framework.
- `script.js` is currently empty and is the natural place for browser-side interactivity if the app grows.
- `konfigurator.php` is the server-side PHP entry point; treat it as the place for form or request handling, but keep the logic lightweight and educational.

## Architecture and data flow
- The site is intentionally static: HTML is served directly, with assets referenced by relative paths (for example `bmw-logo.jpg`, `BMW-E92.jpg`).
- There is no API layer, database, or package manager in this project. If you add behavior, prefer client-side JS for view logic and PHP only for server-side request handling.
- The existing structure suggests a small learning project: front-end markup in HTML, styling in CSS, and optional PHP logic in `konfigurator.php`.

## Conventions to preserve
- Keep changes minimal and in the same style as the current files.
- The project mixes Czech and English naming (`karty0`, `karty1`, `navbar`, `BMW-E92`, etc.); follow the repository’s existing naming patterns when editing existing code.
- Use plain, readable HTML/CSS/JS rather than abstraction layers. Do not add TypeScript, npm tooling, React, or a framework unless the user explicitly asks.
- Preserve relative asset paths and existing filenames when referencing images.

## Local workflow
- To run the PHP part locally: `cd spsMarekPacl/ukol && php -S localhost:8000`
- Open `http://localhost:8000` in the browser to view the page.
- `index.html` can also be opened directly in a browser for quick static preview.
- There is no test suite or build command in this repo; validate changes by checking the page renders correctly in the browser and that PHP files remain syntactically valid.

## Editing guidance
- Use the existing files as the source of truth: `index.html` for structure, `stylesheet.css` for visuals, `script.js` for front-end behavior, and `konfigurator.php` for PHP logic.
- Prefer small, direct changes over refactors. This is a learning project and should stay approachable.
- When adding a new feature, keep it consistent with the current visual and code patterns rather than introducing a new architecture.
