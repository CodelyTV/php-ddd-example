<?php

namespace CodelyTv\Api\Controller\VideoLike;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Api\Infrastructure\Response\ApiHttpCreatedResponse;
use CodelyTv\Context\Video\Module\VideoLike\Application\Create\CreateVideoLikeCommand;
use CodelyTv\Types\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\Request;

/**
 * VideoLikePostController
 */
class VideoLikePostController extends ApiController
{

    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request)
    {
        $command = new CreateVideoLikeCommand(
            new Uuid($request->get('request_id')),
            $request->get('id'),
            $request->get('video_id'),
            $request->get('user_id')
        );

        $this->dispatch($command);

        return new ApiHttpCreatedResponse();
    }
}