# OCM TEST ON FAKE PRODUCTS

- A simple application to store, display, and search products using Laravel and Vue.js.

- With data fetched from the Fake products API: https://fakestoreapi.com/products.
____________________________________________________________________
## Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL
____________________________________________________________________
## Installation Steps

### 1. Clone the Repository

```
git clone https://github.com/basel-kaffoura/ocm-test.git
cd ocm-test
```


### 2. Install PHP Dependencies

```
composer install
```


### 3. Set Up Environment File:

- Copy .env.example to .env file
- Edit the following lines in .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ocm_db
DB_USERNAME=root
DB_PASSWORD=
```


### 4. Generate Application Key

```
php artisan key:generate
```


### 5. Create the Database and Migrate

- Create a new database named ocm_db (or the name you set in .env).
- Run Migrations

```
php artisan migrate
```


### 6. Install JavaScript Dependencies and Build Assets

```
npm install
npm run build
```


### 7. Run the Application

```
php artisan serve
```
____________________________________________________________________
## Usage

- Access the app at http://localhost:8000 or http://localhost:8000/products.

- Click the _**"Refresh from API to DB to Page"**_ button to fetch products from the Fake Store API, store them in the database and retrieve them.

- Use the search input to filter products by title, description, or category.

- Products will be displayed in responsive cards with image, title, description, price, category, and rating.
____________________________________________________________________
## Project Structure

- `app/Models/Product.php` — Product model

- `app/Http/Controllers/ProductController.php` — Handles product-related routes

- `app/Services/ProductService.php` — Business logic for fetching/storing/searching products

- `resources/js/components/ProductsComponent.vue` — Vue component for displaying/searching products

- `resources/js/app.js` — Main JavaScript entry point

- `resources/css/app.css` — Main CSS file

- `resources/views/products/index.blade.php` — Blade view for the products page

- `resources/views/layouts/app.blade.php` — Main layout of the app

- `routes/web.php` — Web routes

- `routes/api.php` — API routes

- `database/migrations/` — Migrations for creating and modifying _**products**_ table
____________________________________________________________________
## Get In Touch

- **Email : baselkaffoura@gmail.com**

- **Phone : +971503898795**
