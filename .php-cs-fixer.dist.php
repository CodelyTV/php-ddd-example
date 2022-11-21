<?php

$finder = PhpCsFixer\Finder::create()->in(
    [
        __DIR__ . '/apps/backoffice/backend/src',
        __DIR__ . '/apps/backoffice/frontend/src',
        __DIR__ . '/apps/mooc/backend/src',
        __DIR__ . '/apps/mooc/frontend/src',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]
);

$config = new PhpCsFixer\Config();

return $config->setRules(
    [
        '@PSR12' => true,
        'strict_param' => true,
        'modernize_strpos' => true,
        'array_syntax' => ['syntax' => 'short'],
    ]
)->setFinder($finder);
