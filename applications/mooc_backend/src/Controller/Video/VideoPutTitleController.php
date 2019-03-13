<?php

declare(strict_types=1);

namespace CodelyTv\MoocBackend\Controller\Video;

use CodelyTv\Mooc\Videos\Application\Update\UpdateVideoTitleCommand;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpOkResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VideoPutTitleController extends ApiController
{
    public function __invoke(Request $request)
    {
        $command = new UpdateVideoTitleCommand(
            new Uuid($request->get('request_id')),
            $request->get('video')
        );

        $this->dispatch($command);

        return new ApiHttpOkResponse();
    }

    protected function exceptions(): array
    {
        return [
            VideoNotFound::class => Response::HTTP_NOT_FOUND,
        ];
    }
}