<?php

namespace CodelyTv\Context\Video\Test\PhpUnit;

use CodelyTv\Test\PhpUnit\TestCase\Module\ModuleFunctionalTestCase;

abstract class VideoContextFunctionalTestCase extends ModuleFunctionalTestCase
{
    protected function environmentArrangers()
    {
        return [
            $this->service('codely.video.infrastructure.arranger'),
        ];
    }
}
