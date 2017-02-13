<?php

namespace CodelyTv\Api\Controller\Video;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Context\Video\Module\Video\Domain\Find\FindVideoQuery;
use CodelyTv\Context\Video\Module\Video\Domain\Find\VideoNotFound;
use Symfony\Component\HttpFoundation\Response;

final class VideoGetController extends ApiController
{
    protected function exceptions(): array
    {
        return [
            VideoNotFound::class => Response::HTTP_NOT_FOUND,
        ];
    }

    public function __invoke(string $id)
    {
        return $this->ask(new FindVideoQuery($id));
    }
}
