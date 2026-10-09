# Laravel Student API Debugging Exercise

A student API coursework project built with Laravel 12 and PHP. This version includes explicit student routes and a logging check endpoint.

## Application location

The Laravel application is in [`php-laravel-api-main/student-api/`](php-laravel-api-main/student-api/). Its existing [README](php-laravel-api-main/student-api/README.md) contains Laravel framework information. The PDF in the repository root contains the assignment material.

## Requirements

- PHP 8.2 or newer, with the extensions required by Composer.
- Composer.
- A local database supported by the application configuration.

## Local setup

```sh
cd php-laravel-api-main/student-api
composer install
```

Copy `.env.example` to `.env` if you do not already have a local environment file. Configure your local database connection, create the database if needed, then run:

```sh
php artisan key:generate
php artisan migrate
php artisan serve
```

Use a development database. The server normally starts at `http://127.0.0.1:8000`. To inspect the registered API routes:

```sh
php artisan route:list --path=api
```

`routes/api.php` declares `/students`, `/student/{id}`, `/update/{id}`, `/delete/{id}`, and `/test-log`. Use `route:list` to confirm their API prefixes and HTTP methods. The log check writes to `storage/logs/laravel.log`.

## Source guide

- `app/`: application code and controllers.
- `routes/api.php`: student API routes.
- `database/`: migrations and database support.
- `tests/`: Laravel test files.
- `.env.example`: environment template.

Run `php artisan test` from the application directory to run its tests. If working with frontend assets, install Node.js dependencies there using `npm install`; inspect `package.json` for the available asset scripts.

## Attribution

This repository is a fork of [programming-languages-38562/php-laravel-debugging](https://github.com/programming-languages-38562/php-laravel-debugging).
