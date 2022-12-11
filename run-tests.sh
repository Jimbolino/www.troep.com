#!/bin/sh
set -e

find . -type f -name '*.php' ! -path './vendor/*' -exec php -l -n {} \; | (! grep -v "No syntax errors detected" )

PHAN_DISABLE_XDEBUG_WARN=1 ./vendor/bin/phan --no-progress-bar

XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-text --colors=never

PHP_CS_FIXER_IGNORE_ENV=1 ./vendor/bin/php-cs-fixer fix --dry-run

echo 'all tests passed!'
