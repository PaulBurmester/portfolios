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
- Routes: `routes/web.php` defines app routes (`/`, `/dashboard`, `/profile` CRUD, and `/securities` — all resource groups under the `auth` middleware) and pulls in `routes/auth.php` (Breeze-generated auth routes)
- Controllers: `app/Http/Controllers/Controller.php` is the abstract base class all controllers extend. `Auth/*Controller.php` are Breeze-generated; `Userzone/ProfileController.php` and `Financezone/SecurityController.php` are the app-specific controllers (`SecurityController` currently has `index()`, `create()`, and `store()` implemented; `show`/`edit`/`update`/`destroy` are still empty resource-controller stubs)
- Form validation: `app/Http/Requests/` (`ProfileUpdateRequest`, `Auth/LoginRequest`)
- Models: `app/Models/User.php`, `Security.php`, `Portfolio.php`, `Holding.php` — see "Projektzwischenstand" below for the portfolio-domain models and their relationships
- Views: `resources/views/` — `layouts/{app,guest,app_navigation}.blade.php`, `userzone/` (dashboard, profile edit), `financezone/security/` (index, create), `auth/*`, `components/form-text-input.blade.php` (own anonymous Blade component for form fields) and `components/breeze/*` (Breeze's default Blade components were deliberately relocated into this subfolder, a deviation from stock Breeze layout)
- Database: SQLite (`database/database.sqlite`); stock migrations (users, cache, jobs) plus the portfolio-domain migrations (`securities`, `portfolios`, `holdings`) — see "Projektzwischenstand" below
- Frontend build: Vite + Tailwind CSS + Alpine.js

## Testing

Tests use **Pest** (not raw PHPUnit, despite the `phpunit.xml` config file), split into `tests/Unit` and `tests/Feature`. Current coverage is Breeze's stock auth/profile feature tests plus the default example tests.

## Portfolio-Management-App (Kursprojekt)
PHP-Projekt im Rahmen eines Lernkurses (Git, Testing, OOP, Tooling).

## Constraint
DB-Design ist vorerst auf 3 Objekte begrenzt (Projekt sollte simpel bleiben)

## Projektzwischenstand (Stand: 2026-09-30)

### Domain-Design (final für die 3-Objekte-Grenze)
- **Security** (Stammdaten, unabhängig): `name`, `ticker`, `ISIN` (unique, 12 Zeichen), `type` (optional), `current_price` (nullable — bewusst so belassen, weil der Preis später automatisiert per Yahoo-API nachgezogen werden soll und beim Anlegen einer Security noch unbekannt sein kann; Spalte heißt in Migration/Model tatsächlich `price`, nicht `current_price`). hasMany Holdings.
- **Portfolio** (gehört einem User): `user_id` (FK), `name`. belongsTo User, hasMany Holdings.
- **Holding** (eigenständiges Model, keine reine Pivot-Tabelle — trägt eigene fachliche Daten): `portfolio_id` (FK), `security_id` (FK), `quantity`, `purchase_price`, `purchase_date`. belongsTo Portfolio, belongsTo Security.

Many-to-many zwischen Portfolio und Security läuft indirekt über Holding. Migrationsreihenfolge wegen FK-Abhängigkeiten: **Security → Portfolio → Holding** (Holding hängt von beiden ab, muss zuletzt kommen; Security/Portfolio sind untereinander unabhängig).

### Fortschritt
- ✅ `database/migrations/2026_09_06_191056_securities.php` fertig: `name`/`ticker`/`ISIN` Pflichtfelder, `ISIN` unique + 12 Zeichen Länge, `price`/`type` nullable
- ✅ `Security`-Eloquent-Model (`app/Models/Security.php`) fertig: `$fillable` mit `name`/`ticker`/`ISIN`/`price`/`type`, `$casts` für `price` (`decimal:2`), `hasMany(Holding::class)`
- ✅ `database/migrations/2026_09_09_100739_create_portfolios_table.php` fertig: `user_id` als FK via `foreignId()->constrained()->onDelete('cascade')`, `name`
- ✅ `Portfolio`-Eloquent-Model (`app/Models/Portfolio.php`) fertig: `$fillable` mit `user_id`/`name`, `belongsTo(User::class)`, `hasMany(Holding::class)`
- ✅ `database/migrations/2026_09_11_065424_create_holdings_table.php` fertig: `portfolio_id` mit `constrained()->onDelete('cascade')` (Portfolio gelöscht → Holdings mitgelöscht), `security_id` mit `constrained()` ohne explizites `onDelete` (DB-Default verhindert Löschen einer referenzierten Security), `quantity` als `unsignedInteger` (bewusst: keine Bruchstücke im Scope), `purchase_price` als `decimal(15, 2)`, `purchase_date` als `date`
- ✅ `Holding`-Eloquent-Model (`app/Models/Holding.php`) fertig: `$fillable` mit `portfolio_id`/`security_id`/`quantity`/`purchase_price`/`purchase_date`, `belongsTo(Portfolio::class)`, `belongsTo(Security::class)`, `$casts` für `quantity` (`integer`), `purchase_price` (`decimal:2`), `purchase_date` (`date`)
- ✅ Migrationen ausgeführt (`migrate` + `db:seed`), Test-User vorhanden
- ✅ Beziehungen manuell verifiziert (Security/Portfolio/Holding-Kette funktioniert)
- ✅ `SecurityFactory` (`database/factories/SecurityFactory.php`) angelegt
- ✅ **Security-CRUD, Schritt `index`**: `SecurityController::index()` (`app/Http/Controllers/Financezone/SecurityController.php`), View `resources/views/financezone/security/index.blade.php`, Route `GET /securities` → `security.index` (in eigener `auth`-Middleware-Gruppe in `routes/web.php`) — End-to-End getestet, funktioniert
- ✅ **Security-CRUD, Schritt `store`**: `SecurityController::store()` fertig — `$request->validate([...])` (u. a. `unique:securities,ISIN`, `size:12` für ISIN, `decimal:2` + `nullable` für `price`), `Security::create($validated)`, `redirect()->route('security.index')`. Route `POST /securities` → `security.store`. Manuell getestet (kein Pest-Feature-Test bisher — bewusst zurückgestellt, siehe unten)
- ✅ **Security-CRUD, Schritt `create` (Controller + Route)**: `SecurityController::create()` gibt `view('financezone.security.create')` zurück (noch ohne Daten). Route `GET /securities/create` → `security.create`, steht in der `web.php` bewusst vor der `store`-Route (Konvention: feste URLs vor Platzhalter-Routen, hier noch nicht akut, aber für spätere `{security}`-Routen relevant)
- ✅ **Security-CRUD, Schritt `create` (View)**: `resources/views/financezone/security/create.blade.php` fertig und committet (`ebf9ab1`) — Formular mit `method="post"`, `action="{{ route('security.store') }}"`, `@csrf`; pro Feld ein Block aus `label`/`input`/`old()`/`@error`. `required` nur bei den Pflichtfeldern `name`/`ticker`/`ISIN`; `price` als `type="number"` mit `step="0.01"` (passend zu `decimal:2`); `type` vorerst Freitext (Idee für später: `<select>` mit festen Optionen gegen Tippfehler). Noch ohne Styling (bewusst)
- ✅ **End-to-End-Test create/store** im Browser erfolgreich (Login Test-User: `test@example.com` / `password`), 4 Fälle: gültige Daten → Redirect auf Index; doppelte ISIN → Fehlermeldung + `old()`-Werte bleiben; ISIN mit 11 Zeichen → `size:12` greift; leerer Preis → wird akzeptiert
- ✅ **Eigene Validierungs-Fehlermeldungen** in `SecurityController::store()` über das zweite Array von `validate()`, Keys im Format `feld.regel` (Regelname ohne Parameter, z. B. `name.min` statt `name.min:3`). Abgedeckt: `name.required`/`name.min`, `ticker.required`/`ticker.max`, `ISIN.unique`/`ISIN.required`/`ISIN.size`, `price` (reiner Feld-Key — greift laut Laravel-Quellcode als Fallback für alle `price`-Regeln; Empfehlung: auf `price.decimal` umstellen, sobald weitere `price`-Regeln dazukommen). Bei `ticker` wurde `min:1` entfernt (redundant zu `required`). View unverändert, `{{ $message }}` übernimmt die Texte. Manuell getestet, Pint gelaufen, committet (`98c9361`)
- ✅ Entscheidung: `decimal:2` bei `price` bleibt bewusst so (verlangt **genau** 2 Nachkommastellen — `10` oder `10.5` werden abgelehnt, Fehlermeldung weist darauf hin)
- ✅ **Refactor Formularfelder → Blade-Komponente** (eigener Commit, Commit-Nachricht noch offen): anonyme Komponente `resources/views/components/form-text-input.blade.php` (`<x-form-text-input />`), Props `label`, `name` (Pflicht) und `type` (Default `text`). Enthält `label` (`for` = Feldname), `input` (`id`/`name` = Feldname, `value="{{ old($name) }}"`, `{{ $attributes }}` reicht `required`/`step` durch) und den `@error($name)`-Block. Bewusst nur **eine** Komponente für alle Typen (`type="number"` bei `price` per Attribut) statt separater `form-number-input`/`form-textarea` wie im Vorbild `hotspot` des Professors; `id` ist keine eigene Prop (immer = `name`). `create.blade.php` nutzt sie für alle 5 Felder (`name`, `ticker`, `ISIN`, `price`, `type`). Im Browser getestet, gleiches Verhalten wie vorher (Formular, `old()`-Werte, Fehlermeldungen)
- ⬜ Offen in der Komponente: `value`-Prop bzw. Fallback `old($name, $value)`, damit das `edit`-Formular den gespeicherten DB-Wert vorausfüllen kann (erst beim `edit`-Schritt)
- ⬜ Danach (eigener Commit, nach dem Refactor): Styling, z. B. Fehlermeldungen rot (Tailwind-Klasse wie `text-red-600` am `<p>` der Komponente — einmal ändern wirkt auf alle Felder; Vorbild `components/breeze/input-error`)
- ⬜ Danach: Security-CRUD, Schritt `edit` + `update`
- ⬜ Offene Position: Pest-Feature-Test für `store()` (gültige + ungültige Daten, `assertRedirect`/`assertDatabaseHas`/`assertInvalid`, mit `actingAs`) — bewusst nach hinten verschoben, sollte nachgeholt werden, sobald CRUD für Security steht
- ⬜ Portfolio: Controller/View/Route noch offen (nur Migration + Model fertig)
- ⬜ Holding: Controller/View/Route noch offen (nur Migration + Model fertig); auch noch keine Factory
- ⬜ `DatabaseSeeder` seedet bisher nur den Test-User, keine Securities/Portfolios/Holdings
- ⬜ Offene Design-Idee (noch nicht umgesetzt): Gewinn einer Position als berechnetes Attribut (Eloquent Accessor auf `Holding`, aus `security.price`, `purchase_price`, `quantity`), nicht als eigene DB-Spalte, wegen Veraltungsgefahr bei Kursänderungen

## Entwicklungsablauf (Workflow-Konvention)
Pro Feature in dieser Reihenfolge vorgehen: Migration → Model (+ Factory/Seeder) → Controller → View → Route.
- Refactors und reines Styling in eigene Commits trennen, nicht mit Feature-Commits mischen.
- CRUD nicht auf einmal bauen: index, dann create+store, dann edit+update, dann destroy — jeweils eigener Schritt/Commit.
- Styling erst einbauen, wenn die Funktionalität steht, nicht vorher.
- Routen-Datei regelmäßig aufräumen/strukturieren, bevor neue Routen dazukommen.
- Kleine, in sich abgeschlossene Commits mit klarer Beschreibung, was sich fachlich geändert hat.

## Wie du mir helfen sollst
Schreibe standardmäßig KEINEN fertigen Implementierungscode.
Erkläre Konzepte, zeige generische Syntax, lass mich selbst umsetzen.