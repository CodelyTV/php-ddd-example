<?php

namespace CodelyTv\Test\Context\Video;

use CodelyTv\Test\Infrastructure\PHPUnit\Module\ModuleFunctionalTestCase;

abstract class VideoContextFunctionalTestCase extends ModuleFunctionalTestCase
{
    protected function environmentArrangers()
    {
        return [
            $this->service('codely.video.infrastructure.arranger'),
        ];
    }
}
