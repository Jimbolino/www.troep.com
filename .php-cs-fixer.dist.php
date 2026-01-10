<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$finder = (new Finder())
    ->ignoreVCSIgnored(true)
    ->ignoreDotFiles(false)
    ->in([__DIR__, '.phan'])
    ->append([
        '.php-cs-fixer.dist.php',
        'artisan',
        'server.php',
    ])
;

$rules = [
    '@PHP8x0Migration' => true,
    '@PHP8x0Migration:risky' => true,
    '@PHPUnit8x4Migration:risky' => true,
    '@PSR12:risky' => true,
    '@PhpCsFixer' => true,
    '@PhpCsFixer:risky' => true,
    'global_namespace_import' => true,
    'php_unit_internal_class' => false,
    'php_unit_test_class_requires_covers' => false,
];

return (new Config())
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setUnsupportedPhpVersionAllowed(true)
;
