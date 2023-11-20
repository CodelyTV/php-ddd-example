<?php

declare(strict_types=1);

use CodelyTv\CodingStyle;
use PhpCsFixer\Fixer\ClassNotation\FinalClassFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return function (ECSConfig $ecsConfig): void {
	$ecsConfig->paths([__DIR__ . '/apps', __DIR__ . '/src', __DIR__ . '/tests', ]);

	$ecsConfig->sets([CodingStyle::DEFAULT]);

	$ecsConfig->skip([
		FinalClassFixer::class => [
			__DIR__ . '/apps/backoffice/backend/src/BackofficeBackendKernel.php',
			__DIR__ . '/apps/backoffice/frontend/src/BackofficeFrontendKernel.php',
			__DIR__ . '/apps/mooc/backend/src/MoocBackendKernel.php',
			__DIR__ . '/src/Shared/Infrastructure/Bus/Event/InMemory/InMemorySymfonyEventBus.php',
		],
		__DIR__ . '/apps/backoffice/backend/var',
		__DIR__ . '/apps/backoffice/frontend/var',
		__DIR__ . '/apps/mooc/backend/var',
		__DIR__ . '/apps/mooc/frontend/var',
	]);
};
