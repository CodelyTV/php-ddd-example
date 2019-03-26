<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\LatestVideo;

use CodelyTv\Mooc\Videos\Application\Find\FindLatestPublishedVideoQuery;
use CodelyTv\Mooc\Videos\Domain\NoVideos;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use Symfony\Component\HttpFoundation\Response;

final class LatestVideoGetController extends ApiController
{
    protected function exceptions(): array
    {
        return [
            NoVideos::class => Response::HTTP_NO_CONTENT,
        ];
    }

    public function __invoke()
    {
        return $this->ask(new FindLatestPublishedVideoQuery());
    }
}
