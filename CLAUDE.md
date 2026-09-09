# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

This is a Laravel 13 (PHP 8.4) educational starter application (composer package `ndeblauw/starterpack`), just past initial Laravel Breeze scaffolding. Portfolio-domain work is in progress — see "Projektzwischenstand" below for current status.

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
- Database: SQLite (`database/database.sqlite`); stock migrations (users, cache, jobs) plus a first portfolio-domain migration (`securities`) — see "Projektzwischenstand" below
- Frontend build: Vite + Tailwind CSS + Alpine.js

## Testing

Tests use **Pest** (not raw PHPUnit, despite the `phpunit.xml` config file), split into `tests/Unit` and `tests/Feature`. Current coverage is Breeze's stock auth/profile feature tests plus the default example tests.

## Portfolio-Management-App (Kursprojekt)
PHP-Projekt im Rahmen eines Lernkurses (Git, Testing, OOP, Tooling).

## Constraint
DB-Design ist vorerst auf 3 Objekte begrenzt (Projekt sollte simpel bleiben)

## Projektzwischenstand (Stand: 2026-09-09, aktualisiert)

### Domain-Design (final für die 3-Objekte-Grenze)
- **Security** (Stammdaten, unabhängig): `name`, `ticker`, `ISIN` (unique, 12 Zeichen), `type` (optional), `current_price`. hasMany Holdings.
- **Portfolio** (gehört einem User): `user_id` (FK), `name`. belongsTo User, hasMany Holdings.
- **Holding** (eigenständiges Model, keine reine Pivot-Tabelle — trägt eigene fachliche Daten): `portfolio_id` (FK), `security_id` (FK), `quantity`, `purchase_price`, `purchase_date`. belongsTo Portfolio, belongsTo Security.

Many-to-many zwischen Portfolio und Security läuft indirekt über Holding. Migrationsreihenfolge wegen FK-Abhängigkeiten: **Security → Portfolio → Holding** (Holding hängt von beiden ab, muss zuletzt kommen; Security/Portfolio sind untereinander unabhängig).

### Fortschritt
- ✅ `database/migrations/2026_09_06_191056_securities.php` fertig: `name`/`ticker`/`ISIN` Pflichtfelder, `ISIN` unique + 12 Zeichen Länge, `price`/`type` nullable
- ✅ `Security`-Eloquent-Model (`app/Models/Security.php`) fertig: `$fillable` mit `name`/`ticker`/`ISIN`/`price`/`type`. `$casts` für `price` (Decimal/Float) noch nicht besprochen — optional offen
- ✅ `database/migrations/2026_09_09_100739_create_portfolios_table.php` fertig: `user_id` als FK via `foreignId()->constrained()->onDelete('cascade')`, `name`
- ⬜ `Portfolio`-Model — **nächster Schritt**
- ⬜ Holding-Migration + Model (zuletzt, wegen doppelter FK-Abhängigkeit auf `portfolios` und `securities`)
- ⬜ Beziehungen (`hasMany`/`belongsTo`) in den Models
- ⬜ Controller/Routes für die drei Objekte

## Wie du mir helfen sollst
Schreibe standardmäßig KEINEN fertigen Implementierungscode.
Erkläre Konzepte, zeige generische Syntax, lass mich selbst umsetzen.