#!/bin/sh
set -e

echo '[php -l]'
find . -type f -name '*.php' ! -path './vendor/*' -exec php -l -n {} \; | (! grep -v "No syntax errors detected" )

echo '[phan]'
PHAN_DISABLE_XDEBUG_WARN=1 ./vendor/bin/phan --no-progress-bar

echo '[phpunit]'
XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-text --colors=never

echo '[php-cs-fixer]'
./vendor/bin/php-cs-fixer fix --dry-run

echo 'all tests passed!'
