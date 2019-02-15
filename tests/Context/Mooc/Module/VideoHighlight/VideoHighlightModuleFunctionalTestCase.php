<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Mooc\Module\VideoHighlight;

use CodelyTv\Context\Mooc\Module\Video\Domain\VideoRepository;
use CodelyTv\Test\Context\Mooc\MoocContextFunctionalTestCase;

abstract class VideoHighlightModuleFunctionalTestCase extends MoocContextFunctionalTestCase
{
    protected function repository(): VideoRepository
    {
        return $this->service('codely.mooc.video_highlight.repository');
    }
}
