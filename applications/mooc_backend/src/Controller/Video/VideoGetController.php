<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\Video;

use CodelyTv\Mooc\Videos\Application\Find\FindVideoQuery;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
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
