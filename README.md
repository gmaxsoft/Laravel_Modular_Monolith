# Laravel Modular Monolith

**Gotowy szablon aplikacji Laravel 12 z architekturą Modular Monolith** — idealny punkt wyjścia do budowy skalowalnych aplikacji webowych z jasno wyodrębnionymi modułami biznesowymi.

---

## Spis treści

- [O projekcie](#o-projekcie)
- [Architektura Modular Monolith](#architektura-modular-monolith)
- [Stack technologiczny](#stack-technologiczny)
- [Struktura projektu](#struktura-projektu)
- [Instalacja](#instalacja)
- [Konto demo](#konto-demo)
- [Testy](#testy)
- [Użycie](#użycie)
- [Moduły](#moduły)
- [Interfejs użytkownika](#interfejs-użytkownika)

---

## O projekcie

Projekt stanowi **gotowy szablon** do szybkiego rozpoczęcia pracy nad aplikacją opartą na architekturze Modular Monolith. Zawiera wstępnie skonfigurowane moduły **Auth** (logowanie, rejestracja, odzyskiwanie hasła) oraz **UserManagement** (profil użytkownika, ustawienia konta), które można rozbudowywać lub zastępować własną logiką.

Interfejs użytkownika opiera się na **Tailwind CSS 4** z nowoczesnym designem — ciemne tło z gradientem na ekranach auth, białe karty z zaokrąglonymi rogami, spójna paleta kolorów (indigo, slate). Przy wejściu na stronę główną (`/`) użytkownik niezalogowany jest przekierowywany od razu na formularz logowania.

---

## Architektura Modular Monolith

### Czym jest Modular Monolith?

Modular Monolith to architektura, w której aplikacja pozostaje pojedynczą monolitową jednostką wdrożeniową, ale wewnętrznie jest podzielona na **niezależne moduły** z własną logiką, trasami, kontrolerami i modelami. Każdy moduł ma jasno określone granice i odpowiedzialność.

### Implementacja w tym projekcie

Architektura została zrealizowana przy użyciu pakietu **nwidart/laravel-modules**:

1. **Moduły w katalogu `Modules/`** — każdy moduł ma własną strukturę katalogów (app, routes, views, database itd.) i jest traktowany jak osobna „miniaplikacja”.

2. **Rejestracja providerów** — moduły rejestrują swoje Service Providery w `bootstrap/providers.php` (struktura Laravel 12), co zapewnia kontrolę nad kolejnością ładowania.

3. **Autoloading PSR-4** — namespace `Modules\` jest mapowany na katalog `Modules/` w `composer.json`. Dodatkowo **wikimedia/composer-merge-plugin** łączy `composer.json` z każdego modułu, umożliwiając autoload klas z modułów.

4. **Izolacja modułów** — każdy moduł ma własne:
   - **Routes** — `routes/web.php`, `routes/api.php`
   - **Controllers** — `app/Http/Controllers/`
   - **Models** — `app/Models/`
   - **Views** — `resources/views/`
   - **Providers** — `app/Providers/` (RouteServiceProvider, EventServiceProvider itd.)

5. **Komunikacja między modułami** — moduły mogą korzystać ze wspólnych elementów (np. `App\Http\Controllers\Controller`) oraz referencjonować się nawzajem przez namespace. Moduł Auth korzysta z modelu `Modules\UserManagement\Models\User` — model użytkownika należy do modułu UserManagement, który jest odpowiedzialny za dane użytkownika.

---

## Stack technologiczny

| Warstwa | Technologia |
|---------|-------------|
| **Framework** | Laravel 12 |
| **PHP** | 8.2+ |
| **Moduły** | nwidart/laravel-modules ^12.0 |
| **Frontend** | Vite 7, Tailwind CSS 4, Axios |
| **Baza danych** | MySQL (domyślnie) / PostgreSQL / SQLite |
| **Testy** | PHPUnit 11 |
| **Formatowanie kodu** | Laravel Pint |
| **Środowisko dev** | Laravel Sail, Laravel Herd |

---

## Struktura projektu

```
laravel_modular/
├── app/                          # Główna aplikacja Laravel
│   ├── Http/
│   │   └── Controllers/
│   │       └── Controller.php    # Bazowy kontroler
│   └── Providers/
│       └── AppServiceProvider.php
│
├── Modules/                      # Moduły biznesowe
│   ├── Auth/                    # Moduł autentykacji (używa User z UserManagement)
│   │   ├── app/
│   │   │   ├── Http/Controllers/
│   │   │   │   ├── Controller.php           # Bazowy kontroler modułu
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── PasswordResetLinkController.php
│   │   │   │   └── NewPasswordController.php
│   │   │   └── Providers/
│   │   │       ├── AuthServiceProvider.php
│   │   │       ├── RouteServiceProvider.php
│   │   │       └── EventServiceProvider.php
│   │   ├── database/
│   │   │   └── seeders/
│   │   ├── resources/
│   │   │   └── views/
│   │   │       ├── login.blade.php
│   │   │       ├── register.blade.php
│   │   │       ├── forgot-password.blade.php
│   │   │       └── reset-password.blade.php
│   │   ├── routes/
│   │   │   ├── web.php
│   │   │   └── api.php
│   │   ├── config/
│   │   ├── module.json
│   │   └── composer.json
│   │
│   └── UserManagement/          # Moduł zarządzania użytkownikami (właściciel modelu User)
│       ├── app/
│       │   ├── Http/Controllers/
│       │   │   ├── Controller.php           # Bazowy kontroler modułu
│       │   │   ├── ProfileController.php
│       │   │   └── AccountSettingsController.php
│       │   ├── Models/
│       │   │   ├── User.php                 # Model użytkownika (używany przez Auth)
│       │   │   └── Profile.php
│       │   └── Providers/
│       ├── database/
│       │   ├── factories/
│       │   │   └── UserFactory.php
│       │   └── seeders/
│       ├── resources/
│       │   └── views/
│       │       ├── profile/
│       │       └── account-settings/
│       ├── routes/
│       ├── module.json
│       └── composer.json
│
├── bootstrap/
│   ├── app.php
│   └── providers.php            # Rejestracja providerów modułów
│
├── config/
│   ├── auth.php                 # Model User → Modules\UserManagement\Models\User
│   └── modules.php              # Konfiguracja nwidart/laravel-modules
│
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
│
├── resources/
│   └── views/
│       └── welcome.blade.php
│
├── routes/
│   ├── web.php                  # / → przekierowanie na login (gość) lub profil (zalogowany)
│   └── console.php
│
├── tests/
│   ├── Unit/                    # Testy jednostkowe (User, UserFactory, DatabaseSeeder)
│   ├── Feature/                 # Testy integracyjne (HTTP)
│   └── TestCase.php
│
├── composer.json                # PSR-4: Modules\ → Modules/
├── package.json
└── README.md
```

---

## Instalacja

```bash
# Klonowanie repozytorium
git clone <url-repozytorium> laravel_modular
cd laravel_modular

# Instalacja zależności PHP
composer install

# Konfiguracja środowiska
cp .env.example .env
php artisan key:generate

# Konfiguracja MySQL (domyślnie)
# W .env ustaw: DB_CONNECTION=mysql, DB_DATABASE=laravel_modular, DB_USERNAME, DB_PASSWORD
# Utwórz bazę: CREATE DATABASE laravel_modular CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Instalacja zależności Node.js
npm install

# Migracje bazy danych
php artisan migrate

# Seedowanie bazy (tworzy konto demo)
php artisan db:seed

# Budowanie assetów
npm run build
```

### Uruchomienie w trybie deweloperskim

```bash
composer run dev
```

Uruchomi jednocześnie serwer PHP, kolejkę i Vite.

### Konto demo

Po uruchomieniu `php artisan db:seed` dostępne jest konto do testowania:

| Pole     | Wartość           |
|----------|-------------------|
| **Email** | `demo@example.com` |
| **Hasło** | `demo123`          |

---

## Testy

Projekt wykorzystuje **PHPUnit 11** do testów. Baza danych w testach używa SQLite w pamięci (konfiguracja w `phpunit.xml`).

### Uruchamianie testów

```bash
# Wszystkie testy (alternatywnie: composer test)
php artisan test --compact

# Tylko testy jednostkowe
php artisan test --compact tests/Unit

# Tylko testy feature
php artisan test --compact tests/Feature

# Konkretny plik lub metoda
php artisan test --compact tests/Unit/UserTest.php
php artisan test --compact --filter=test_seeder_creates_demo_user
```

### Struktura testów

| Katalog      | Opis                                                                 |
|--------------|----------------------------------------------------------------------|
| `tests/Unit` | Testy jednostkowe — model User, UserFactory, DatabaseSeeder         |
| `tests/Feature` | Testy integracyjne — HTTP, przekierowania, pełne przepływy       |

### Tworzenie nowych testów

```bash
# Test jednostkowy
php artisan make:test Unit/NazwaTest --unit --phpunit

# Test feature
php artisan make:test Feature/NazwaTest --phpunit
```

---

## Użycie

### Tworzenie nowego modułu

```bash
php artisan module:make NazwaModulu
```

### Generowanie elementów w module

```bash
# Kontroler
php artisan module:make-controller NazwaKontrolera NazwaModulu

# Model
php artisan module:make-model NazwaModelu NazwaModulu

# Migracja
php artisan module:make-migration create_tabela NazwaModulu

# Widok
php artisan module:make-view nazwa-widoku NazwaModulu
```

### Rejestracja nowego modułu

Po utworzeniu modułu dodaj jego Service Provider do `bootstrap/providers.php`:

```php
\Modules\NazwaModulu\Providers\NazwaModuluServiceProvider::class,
```

Następnie uruchom:

```bash
composer dump-autoload
```

---

## Moduły

### Auth

Moduł odpowiedzialny za autentykację użytkowników (logowanie, rejestracja, odzyskiwanie hasła). Wykorzystuje domyślne mechanizmy Laravel 12, ograniczone do tego modułu. **Zależy od modelu User z modułu UserManagement.**

- **Logowanie** — `GET/POST /login`
- **Rejestracja** — `GET/POST /register`
- **Odzyskiwanie hasła** — `GET/POST /forgot-password`, `GET/POST /reset-password/{token}`
- **Wylogowanie** — `POST /logout`

Kontrolery: `LoginController`, `RegisterController`, `PasswordResetLinkController`, `NewPasswordController`

### UserManagement

Moduł zarządzania kontem i profilem użytkownika. **Właściciel modelu User** — przechowuje dane użytkownika używane przez moduł Auth. Wymaga zalogowania.

- **Profil** — `GET /user-management/profile`
- **Edycja profilu** — `GET /user-management/profile/edit`, `PUT /user-management/profile`
- **Ustawienia konta** — `GET /user-management/account-settings`
- **Zmiana hasła** — `PUT /user-management/account-settings/password`

Model użytkownika: `Modules\UserManagement\Models\User`

---

## Interfejs użytkownika

Aplikacja wykorzystuje **Tailwind CSS 4** z Vite do budowy interfejsu:

- **Strona główna** — adres `/` przekierowuje gości na `/login`, zalogowanych na `/user-management/profile`
- **Ekrany auth** — ciemne tło z gradientem (slate-900), białe karty z cieniem i zaokrąglonymi rogami
- **Profil i ustawienia** — jasne tło (slate-50), nagłówek z nawigacją, karty z gradientem w nagłówku
- **Czcionka** — Figtree (Google Fonts)
- **Kolory** — indigo (akcenty, przyciski), slate (tła, tekst)

### Uruchomienie assetów

```bash
# Tryb deweloperski (hot reload)
npm run dev

# Produkcja
npm run build
```

---

## Licencja

MIT License
