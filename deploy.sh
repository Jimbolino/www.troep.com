#!/bin/sh
set -e

# remove dev packages
composer install --classmap-authoritative --no-dev

# deploy
serverless deploy


