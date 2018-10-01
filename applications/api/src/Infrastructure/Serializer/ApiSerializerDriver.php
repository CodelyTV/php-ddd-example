<?php

declare(strict_types = 1);

namespace CodelyTv\Api\Infrastructure\Serializer;

use CodelyTv\Context\Video\Module\User\Application\Find\UserResponse;
use CodelyTv\Context\Video\Module\Video\Application\Find\VideoResponse;
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
            UserResponse::class  => [
                'id'                 => ['type' => 'string'],
                'name'               => ['type' => 'string'],
                'totalPendingVideos' => ['type' => 'string'],
            ],
            VideoResponse::class => [
                'id'       => ['type' => 'string'],
                'type'     => ['type' => 'string'],
                'title'    => ['type' => 'string'],
                'url'      => ['type' => 'string'],
                'courseId' => ['type' => 'string'],
            ],
        ];
    }
}
