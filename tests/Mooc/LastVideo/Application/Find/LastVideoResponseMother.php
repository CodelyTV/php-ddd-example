<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Application\Find;

use CodelyTv\Mooc\LastVideo\Application\Find\LastVideoResponse;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoTitle;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoType;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoUrl;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoTitleMother;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoTypeMother;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoUrlMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;

final class LastVideoResponseMother
{
    public static function create(?VideoId $videoId = null,
                                  ?LastVideoType $type = null,
                                  ?LastVideoTitle $title = null,
                                  ?LastVideoUrl $url = null,
                                  ?CourseId $courseId = null,
    ): LastVideoResponse
    {
        return new LastVideoResponse(
            $videoId?->value() ?? VideoIdMother::create()->value(),
            $type?->value() ?? LastVideoTypeMother::create()->value(),
            $title?->value() ?? LastVideoTitleMother::create()->value(),
            $url?->value() ?? LastVideoUrlMother::create()->value(),
            $courseId?->value() ?? CourseIdMother::create()->value(),
        );
    }
}
