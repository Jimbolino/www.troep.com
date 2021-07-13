#!/bin/sh
set -e

# remove dev packages
composer install --classmap-authoritative --no-dev

# enable laravel routes caching
./artisan route:cache

# deploy
serverless deploy

# switch back to develop mode
./artisan optimize:clear
composer install
