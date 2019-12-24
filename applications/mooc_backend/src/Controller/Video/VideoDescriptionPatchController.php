<?php

declare (strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\Video;

use CodelyTv\Mooc\Videos\Application\Modify\Description\ModifyDescriptionVideoCommand;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpNoContentResponse;
use Symfony\Component\HttpFoundation\Request;

final class VideoDescriptionPatchController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $videoId, Request $request): ApiHttpNoContentResponse
    {
        $requestId = new Uuid($request->get('request_id'));

        $command = new ModifyDescriptionVideoCommand(
            $requestId,
            $videoId,
            $request->get('newDescription')
        );

        $this->dispatch($command);

        return new ApiHttpNoContentResponse($request->getPathInfo(), $requestId);
    }
}
