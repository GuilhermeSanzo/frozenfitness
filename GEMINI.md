# Project Overview: Frozen Fitness (Laravel Migration)
A modern reimagining of the Frozen Fitness e-commerce platform, migrating from legacy procedural PHP to the Laravel framework. Focus on modern MVC, English-only standardization, and SQLite portability.

## Main Technologies
- **Framework:** Laravel 11.x
- **Language:** PHP 8.2+
- **Database:** SQLite (for portability and ease of setup)
- **Frontend:** Blade Templates, Tailwind CSS
- **Authentication:** Laravel Breeze
- **Package Managers:** Composer, NPM

## Architecture & Language Policy (CRITICAL)
1. **ENGLISH ONLY:** All code, database tables, columns, models, controllers, variables, and commit messages MUST be strictly in English. No Portuguese remains in the new codebase.
2. **Structure:** Adhere to standard Laravel conventions:
    - **Models:** Eloquent models with proper relationships.
    - **Views:** Blade templates with Tailwind CSS.
    - **Controllers:** Resource-based controllers for CRUD operations.
    - **Migrations:** Version-controlled English schema.
    - **Routes:** Organized web and api routes.

## Development Conventions
- **Atomic Commits:** Small, focused commits with clear English descriptions.
- **Eloquent ORM:** Prefer Eloquent over raw SQL for all database interactions.
- **SQLite Usage:** Ensure the application remains portable by using SQLite as the primary development database.
- **Form Requests:** Use dedicated Form Request classes for validation logic.
- **PSR-12:** Follow PSR-12 coding standards for PHP.

## Initial Database Schema (Target English Architecture)
The target schema translates legacy concepts into a normalized English structure:
- **Base Entities:**
    - `categories` (formerly `tipo_dieta` / `categoria_prato`)
    - `promotions` (formerly `promocao`)
    - `ingredients` (formerly `ingrediente`)
- **Relational Entities:**
    - `users` (standard Laravel structure)
    - `meals` (formerly `prato` - links to categories)
    - `diets` (links to categories)
    - `meal_ingredient` (pivot)
    - `diet_meal` (pivot)
    - `meal_promotion` (pivot)

## Next Steps
- [x] Step 1: Update GEMINI.md directives (Current).
- [x] Step 2: Install fresh Laravel project and configure SQLite.
- [x] Step 3: Generate target English Migrations and Models.
- [x] Step 4: Build custom Seeders to migrate legacy Portuguese data into the new English SQLite structure.
- [x] Step 5: Implement Public Area (Controllers & Blade views for Home, Meals, Diets).
- [x] Step 6: Implement Admin Dashboard (Breeze & CRUDs).
    - [x] Admin Dashboard UI implemented.
    - [x] Categories CRUD.
    - [x] Ingredients CRUD.
    - [x] Meals CRUD.
    - [x] Diets CRUD.
- [x] Step 7: The E-commerce Core.
    - [x] Legacy Data Migrated via Seeder.
    - [x] Image support migrated and integrated (Meals & Ingredients).
    - [x] Customer Auth & Roles.
    - [x] Shopping Cart Session Logic.
- [x] Step 8: Checkout & Orders.
    - [x] Order & OrderItem Models/Migrations.
    - [x] Checkout Logic (Session to DB).
    - [x] Order History View.
