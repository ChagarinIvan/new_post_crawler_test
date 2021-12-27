#!/bin/bash

composer install
composer run-script post-root-package-install
composer dump-autoload

php artisan key:generate --ansi
php artisan migrate
