<?php

declare (strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\Video;

use CodelyTv\Mooc\Videos\Application\Trim\TrimVideoCommand;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpAcceptedResponse;
use Symfony\Component\HttpFoundation\Request;

final class VideoDurationPatchController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke($videoId, Request $request): ApiHttpAcceptedResponse
    {
        $requestId = new Uuid($request->get('request_id'));

        $command = new TrimVideoCommand(
            $requestId,
            $videoId,
            $request->get('keep_from_second'),
            $request->get('keep_to_second')
        );

        $this->dispatch($command);

        return new ApiHttpAcceptedResponse($request->getPathInfo(), $requestId);
    }
}
