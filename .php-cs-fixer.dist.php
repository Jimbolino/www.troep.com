<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__, '.phan'])
    ->exclude([
        'bootstrap/cache',
        'node_modules',
        'storage',
    ])
    ->append([
        '.php-cs-fixer.dist.php',
        'artisan',
        'server.php',
    ])
;

$config = new PhpCsFixer\Config();
$config->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP80Migration' => true,
        '@PHP80Migration:risky' => true,
        '@PHPUnit84Migration:risky' => true,
        '@PSR12:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'php_unit_internal_class' => false,
        'php_unit_test_class_requires_covers' => false,
    ])
;

return $config;
