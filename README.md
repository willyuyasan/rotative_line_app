## This is where your Laravel app goes

To get started, **delete this file** and then do one of the following:

- Clone your project or copy all of the files directly into this `src` directory.
- Spin up the Docker network by following the instructions on the main [README.md](../README.md), and install a brand new Laravel project by running `docker-compose run --rm composer create-project laravel/laravel .` in your terminal.


After create the project:

- composer --version
- php artisan --version
- php artisan migrate

- enter to the project file
- follow filament documentation steps
- go to composer.json and change "minimum-stability": "stable", to "dev" to use filament
- composer require filament/filament 
- composer require filament/filament:"^3.2" -W --ignore-platform-req=ext-intl --ignore-platform-req=ext-zip
- php artisan filament:install --panels
- php artisan make:filament-user
- php artisan serve



