<?php

// rector.php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SETS, [SetList::PHP_80]);

    $parameters->set(
        Option::PATHS,
        [
            __DIR__ . '/src',
            __DIR__ . '/tests',
            __DIR__ . '/apps/backoffice/backend/src',
            __DIR__ . '/apps/backoffice/frontend/src',
            __DIR__ . '/apps/mooc/backend/src',
            __DIR__ . '/apps/mooc/frontend/src',
        ]
    );

    $parameters->set(
        Option::EXCLUDE_PATHS,
        [
            __DIR__ . '/src/Shared/Infrastructure/Bus/Event/RabbitMq',
            __DIR__ . '/tests/Shared/Infrastructure/Bus/Event/RabbitMq',
        ]
    );
};
