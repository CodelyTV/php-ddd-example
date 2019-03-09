<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Shared\Infrastructure;

use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Module\ModuleFunctionalTestCase;

abstract class MoocContextFunctionalTestCase extends ModuleFunctionalTestCase
{
    protected function environmentArrangers(): array
    {
        return [
            $this->service(MoocEnvironmentArranger::class),
        ];
    }
}
