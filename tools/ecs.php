<?php

declare(strict_types=1);

use CodelyTv\CodingStyle;
use PhpCsFixer\Fixer\ClassNotation\FinalClassFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        realpath(__DIR__ . '/../apps'),
		realpath(__DIR__ . '/../src'),
		realpath(__DIR__ . '/../tests'),
    ]);

    $ecsConfig->sets([CodingStyle::DEFAULT]);

    $ecsConfig->skip([
        FinalClassFixer::class => [
            realpath(__DIR__ . '/../apps/backoffice/backend/src/BackofficeBackendKernel.php'),
            realpath(__DIR__ . '/../apps/backoffice/frontend/src/BackofficeFrontendKernel.php'),
            realpath(__DIR__ . '/../apps/mooc/backend/src/MoocBackendKernel.php'),
            realpath(__DIR__ . '/../src/Shared/Infrastructure/Bus/Event/InMemory/InMemorySymfonyEventBus.php'),
        ],
        realpath(__DIR__ . '/../apps/backoffice/backend/var'),
        realpath(__DIR__ . '/../apps/backoffice/frontend/var'),
        realpath(__DIR__ . '/../apps/mooc/backend/var'),
        realpath(__DIR__ . '/../apps/mooc/frontend/var'),
    ]);
};
