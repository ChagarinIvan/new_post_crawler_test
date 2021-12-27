#!/bin/bash

cd /new_post_crawler_test
composer install
composer run-script post-root-package-install
composer dump-autoload
php artisan key:generate --ansi
#php artisan migrate
#php artisan collect:new_post
