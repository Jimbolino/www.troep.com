#!/bin/sh
set -e

echo && echo '[php -l]'
if find . -type f -name '*.php' ! -path './vendor/*' -exec php -l -n {} \; | grep -v "No syntax errors detected"; then
    echo 'php -l found syntax errors'
    exit 1
fi

echo && echo '[phan]'
PHAN_DISABLE_XDEBUG_WARN=1 ./vendor/bin/phan --no-progress-bar

echo && echo '[phpunit]'
XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-text --colors=never

echo && echo '[php-cs-fixer]'
./vendor/bin/php-cs-fixer fix ${CI:+--dry-run --diff}

echo 'all tests passed!'
