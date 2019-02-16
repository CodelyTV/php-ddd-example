<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Api\Serializer;

use CodelyTv\Mooc\Module\User\Application\Find\UserResponse;
use CodelyTv\Mooc\Module\Video\Application\Find\VideoResponse;
use CodelyTv\Shared\Infrastructure\Jms\CodelyTvSerializerDriver;

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
