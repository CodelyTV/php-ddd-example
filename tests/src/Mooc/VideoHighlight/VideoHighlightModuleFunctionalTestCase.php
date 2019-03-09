<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoHighlight;

use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Test\Mooc\Shared\Infrastructure\MoocContextFunctionalTestCase;

abstract class VideoHighlightModuleFunctionalTestCase extends MoocContextFunctionalTestCase
{
    protected function repository(): VideoRepository
    {
        return $this->service('codely.mooc.video_highlight.repository');
    }
}
