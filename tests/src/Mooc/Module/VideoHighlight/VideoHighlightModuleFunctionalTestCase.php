<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\VideoHighlight;

use CodelyTv\Mooc\Video\Domain\VideoRepository;
use CodelyTv\Test\Mooc\MoocContextFunctionalTestCase;

abstract class VideoHighlightModuleFunctionalTestCase extends MoocContextFunctionalTestCase
{
    protected function repository(): VideoRepository
    {
        return $this->service('codely.mooc.video_highlight.repository');
    }
}
