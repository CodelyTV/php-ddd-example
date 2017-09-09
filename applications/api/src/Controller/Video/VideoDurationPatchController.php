<?php

declare (strict_types = 1);

namespace CodelyTv\Api\Controller\Video;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Api\Infrastructure\Response\ApiHttpAcceptedResponse;
use CodelyTv\Context\Video\Module\Video\Application\Trim\TrimVideoCommand;
use CodelyTv\Types\ValueObject\Uuid;
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
