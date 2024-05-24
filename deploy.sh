#!/bin/sh
set -e

# remove dev packages
composer install --classmap-authoritative --no-dev

# enable laravel routes caching
./artisan route:cache

# deploy
env | grep SERVERLESS_ACCESS_KEY
npx serverless login
npx serverless deploy

# switch back to develop mode
./artisan config:clear
./artisan route:clear
./artisan view:clear

composer install
