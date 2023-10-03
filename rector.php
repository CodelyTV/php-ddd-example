<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/apps',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_82,
        SetList::TYPE_DECLARATION
    ]);

    $rectorConfig->skip([
        __DIR__ . '/apps/backoffice/backend/var',
        __DIR__ . '/apps/backoffice/frontend/var',
        __DIR__ . '/apps/mooc/backend/var',
        __DIR__ . '/apps/mooc/frontend/var',
    ]);
};
