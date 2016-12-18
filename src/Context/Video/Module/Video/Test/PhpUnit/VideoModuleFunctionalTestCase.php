<?php

namespace CodelyTv\Context\Video\Module\Video\Test\PhpUnit;

use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Video\Test\PhpUnit\VideoContextFunctionalTestCase;

abstract class VideoModuleFunctionalTestCase extends VideoContextFunctionalTestCase
{
    protected function repository(): VideoRepository
    {
        return $this->service('codely.video.video.repository');
    }
}
