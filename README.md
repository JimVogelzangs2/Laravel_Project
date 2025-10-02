# Basic Electronic Webshop

Een eenvoudige Laravel webshop applicatie voor elektronische producten met productbeheer functionaliteit.

## Features

- Product catalogus bekijken
- Winkelwagen functionaliteit
- Producten toevoegen aan winkelwagen
- Nieuwe producten aanmaken via webinterface
- SQLite database voor data opslag
- Moderne, responsive UI

## Installatie

1. **Clone de repository:**
   ```bash
   git clone <repository-url>
   cd laravel_project
   ```

2. **Installeer dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup:**
   - Kopieer `.env.example` naar `.env`
   - Configureer je database settings in `.env` (standaard gebruikt het SQLite)

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
- **Shop:** `http://localhost:8000/shop`
- **Nieuw product aanmaken:** Klik op "Nieuw Product Aanmaken" in de shop

## Database

De applicatie gebruikt SQLite als database. Het database bestand wordt automatisch aangemaakt bij het uitvoeren van de migrations. De database bevat:

- `products` tabel: Product informatie (naam, prijs, beschrijving)
- `users` tabel: Gebruiker accounts
- `sessions` tabel: Sessie data voor winkelwagen

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

- `app/Http/Controllers/ShopController.php` - Shop logica
- `app/Models/Product.php` - Product model
- `resources/views/shop/` - Shop templates
- `database/migrations/` - Database migrations
- `database/seeders/` - Database seeders

## Bijdragen

1. Fork het project
2. Maak een feature branch
3. Commit je changes
4. Push naar de branch
5. Maak een Pull Request

## License

Dit project is gelicenseerd onder de MIT License.
