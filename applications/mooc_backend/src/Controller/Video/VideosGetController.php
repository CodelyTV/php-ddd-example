<?php

namespace CodelyTv\MoocBackend\Controller\Video;

use CodelyTv\Mooc\Video\Application\Find\FindAllVideosQuery;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;

class VideosGetController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke()
    {
        return $this->ask(new FindAllVideosQuery());
    }
}