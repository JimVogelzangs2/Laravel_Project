# Basic Electronic Webshop

Een complete Laravel webshop applicatie voor elektronische producten met gebruikersauthenticatie, productbeheer en categorieën.

## Features

- **Gebruikersauthenticatie**: Login/registratie systeem zonder Breeze
- **Product catalogus**: Bekijken van producten met afbeeldingen
- **Winkelwagen functionaliteit**: Producten toevoegen/verwijderen uit winkelwagen
- **Productbeheer**: CRUD operaties voor producten (aanmaken, bewerken, verwijderen)
- **Categoriebeheer**: Producten organiseren in categorieën
- **Afbeelding upload**: Meerdere afbeeldingen per product
- **Beveiliging**: Alle shop functies vereisen authenticatie
- **SQLite database**: Voor data opslag
- **Moderne, responsive UI**: Met Tailwind CSS styling

## Installatie

1. **Clone de repository:**
   ```bash
   git clone <repository-url>
   cd laravel_project
   ```

2. **Environment setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Installeer dependencies:**
   ```bash
   composer install
   npm install
   ```

4. **Database setup:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Build assets:**
   ```bash
   npm run build
   ```

6. **Start de applicatie:**
   ```bash
   php artisan serve
   ```

De applicatie is nu beschikbaar op `http://localhost:8000`

## Gebruik

- **Homepage:** `http://localhost:8000`
- **Login/Registratie:** `http://localhost:8000/login`
- **Shop:** `http://localhost:8000/shop` (vereist login)
- **Nieuwe producten aanmaken:** Klik op "Nieuw Product" in de shop
- **Categorieën beheren:** Via de zijbalk in de shop

### Authenticatie
- Gebruikers moeten ingelogd zijn om toegang te krijgen tot shop functionaliteit
- Login en registratie zijn beschikbaar op dezelfde pagina
- Logout is beschikbaar in de header na inloggen

## Database

De applicatie gebruikt SQLite als database. Het database bestand wordt automatisch aangemaakt bij het uitvoeren van de migrations. De database bevat:

- `users` tabel: Gebruiker accounts voor authenticatie
- `products` tabel: Product informatie (naam, prijs, beschrijving)
- `categories` tabel: Product categorieën
- `category_product` tabel: Many-to-many relatie tussen producten en categorieën
- `product_images` tabel: Afbeeldingen gekoppeld aan producten
- `sessions` tabel: Sessie data voor winkelwagen en authenticatie

## Ontwikkeling

### Requirements

- PHP 8.1+
- Composer
- Node.js & NPM
- SQLite

### Belangrijke commando's

```bash
# Database reset
php artisan migrate:fresh --seed

# Assets compileren voor development
npm run dev

# Tests uitvoeren
php artisan test
```

## Project Structuur

### Controllers
- `app/Http/Controllers/ShopController.php` - Shop logica en product CRUD
- `app/Http/Controllers/CategoryController.php` - Categorie beheer
- `app/Http/Controllers/Auth/LoginController.php` - Gebruikers login
- `app/Http/Controllers/Auth/RegisterController.php` - Gebruikers registratie

### Models
- `app/Models/User.php` - Gebruiker model
- `app/Models/Product.php` - Product model met image/categorie relaties
- `app/Models/Category.php` - Categorie model
- `app/Models/ProductImage.php` - Product afbeelding model

### Views
- `resources/views/layouts/app.blade.php` - Hoofd layout
- `resources/views/auth/` - Login/registratie templates
- `resources/views/shop/` - Shop templates
- `resources/views/categories/` - Categorie templates

### Database
- `database/migrations/` - Database schema migrations
- `database/seeders/` - Database seeders

## Bijdragen

1. Fork het project
2. Maak een feature branch
3. Commit je changes
4. Push naar de branch
5. Maak een Pull Request

## License

Dit project is gelicenseerd onder de MIT License.
