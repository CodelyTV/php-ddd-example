<?php

namespace CodelyTv\Api\Infrastructure\Serializer;

use CodelyTv\Context\Video\Module\Video\Domain\VideoResponse;
use CodelyTv\Infrastructure\Jms\CodelyTvSerializerDriver;

final class ApiSerializerDriver extends CodelyTvSerializerDriver
{
    public function __construct()
    {
        $this->addResourceFile(__FILE__);
    }

    public function getMetadata()
    {
        return [
            VideoResponse::class => [
                'id'       => ['type' => 'string'],
                'title'    => ['type' => 'string'],
                'url'      => ['type' => 'string'],
                'courseId' => ['type' => 'string'],
            ],
        ];
    }
}
