# AGENTS.md

## Overview
This project is the `juzaweb/contact` module for the Juzaweb CMS. It provides an interface to manage contact submissions. It includes a frontend form for public users and a backend management interface for administrators.

## Architecture
The module follows a typical Laravel/Juzaweb module structure based on the MVC pattern:
- **src/Models**: Contains the Eloquent models (`Contact`).
- **src/Http/Controllers**: Contains the controllers handling logic (`ContactController`).
- **src/Http/Requests**: Contains FormRequest validations.
- **src/Http/DataTables**: Contains the DataTables logic for admin listing grids.
- **src/Providers**: Service providers registering routes, menus, translations, config, and views (`ContactServiceProvider`, `RouteServiceProvider`).
- **src/routes**: Contains `web.php` for frontend routes and `admin.php` for backend routes.
- **resources/views**: Contains the view files for rendering the frontend and backend.
- **resources/lang**: Contains the translation files.
- **database/migrations**: Contains database migrations for the contact module.
- **config**: Configuration files (`contact.php`).
- **tests**: Contains Unit and Feature tests using PHPUnit and Orchestra Testbench.

## Key Technologies Used
- **PHP**: 8.2+
- **Framework**: Laravel 11.x (via Juzaweb Core 5.0+)
- **CMS**: Juzaweb CMS
- **Testing**: PHPUnit (^10.5), Orchestra Testbench (^9.0)
- **Database**: SQLite (in memory) used for testing. MySQL typically used in production.
- **Package Manager**: Composer
- **Node/NPM**: Can be installed for frontend asset building if needed.

## Development Environment Setup and Testing

To start the development server or test the code, follow these instructions:

### Setup Environment
Use the provided `setup.sh` script to install PHP 8.2/8.3, Composer, Node.js, and fetch all necessary package dependencies.
```bash
./setup.sh -p 8.2
```
Or to install Node as well:
```bash
./setup.sh -p 8.2 -npm
```

### Running Tests
The module uses `orchestra/testbench` for isolated environment testing. The test database is configured to use an in-memory SQLite database.
To run tests, simply execute:
```bash
./vendor/bin/phpunit
```

### Note for Module Development and Testing
- When setting up test environments using `orchestra/testbench`, we must explicitly register the aliases for Juzaweb Core. This is handled in `tests/TestCase.php` (`Theme` and `Hook` aliases).
- Testing also requires the `translatable.fallback_locale` to be configured, and `Juzaweb\QueryCache\QueryCacheServiceProvider::class` must be in `getPackageProviders` to prevent errors.
