<?php

declare(strict_types = 1);

namespace CodelyTv\Api\Controller\Video;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Api\Infrastructure\Response\ApiHttpSuccessfullPatchResponse;
use CodelyTv\Context\Video\Module\Video\Application\Create\UpdateVideoTitleCommand;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\Request;

final class VideoPatchTitleController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request)
    {
        $command = new UpdateVideoTitleCommand(
            new Uuid($request->get('request_id')),
            $request->get('id'),
            $request->get('title')
        );

        $this->dispatch($command);

        return new ApiHttpSuccessfullPatchResponse();
    }
}
