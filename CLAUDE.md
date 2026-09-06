# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

This is a Laravel 13 (PHP 8.4) educational starter application (composer package `ndeblauw/starterpack`), currently just past initial Laravel Breeze scaffolding — no portfolio-domain models/controllers exist yet despite the repo name.

**AGENTS.md** in the repo root is the authoritative, Laravel Boost-generated rules file (conventions, Pint/Pest/Herd rules, project structure guidance). Read and follow it — this file only adds a practical command/architecture map on top, without repeating its content.

## Commands

- `composer run setup` — first-time install (composer install, `.env` copy, `key:generate`, `migrate --force`, `npm install`, `npm run build`)
- The app is served by **Laravel Herd** at `http://portfolios.test`. Never run `php artisan serve` or start a manual server — Herd already serves it.
- `npm run dev` / `npm run build` — Vite asset pipeline
- `php artisan test --compact` or `vendor/bin/pest` — run the full test suite
- Single test: `php artisan test --filter=testName` or `vendor/bin/pest tests/Feature/ProfileTest.php`
- `vendor/bin/pint --dirty --format agent` — run after editing any PHP file, before finalizing changes
- `php artisan route:list`, `php artisan tinker --execute '...'` — inspection helpers

## Architecture

Request flow:
- Entry point: `public/index.php` → `bootstrap/app.php` (registers routing/middleware/exception handling; no custom middleware registered yet)
- Routes: `routes/web.php` defines app routes (`/`, `/dashboard`, and `/profile` CRUD under the `auth` middleware group) and pulls in `routes/auth.php` (Breeze-generated auth routes)
- Controllers: `app/Http/Controllers/Controller.php` is the abstract base class all controllers extend. `Auth/*Controller.php` are Breeze-generated; `Userzone/ProfileController.php` is the one app-specific controller
- Form validation: `app/Http/Requests/` (`ProfileUpdateRequest`, `Auth/LoginRequest`)
- Model: `app/Models/User.php` is currently the only Eloquent model
- Views: `resources/views/` — `layouts/{app,guest,app_navigation}.blade.php`, `userzone/` (dashboard, profile edit), `auth/*`, and `components/breeze/*` (Breeze's default Blade components were deliberately relocated into this subfolder, a deviation from stock Breeze layout)
- Database: SQLite (`database/database.sqlite`); only stock migrations exist (users, cache, jobs) — no portfolio-domain schema yet
- Frontend build: Vite + Tailwind CSS + Alpine.js

## Testing

Tests use **Pest** (not raw PHPUnit, despite the `phpunit.xml` config file), split into `tests/Unit` and `tests/Feature`. Current coverage is Breeze's stock auth/profile feature tests plus the default example tests.
