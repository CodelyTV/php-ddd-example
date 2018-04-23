<?php

declare(strict_types=1);

namespace CodelyTv\Api\Controller\Review;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Api\Infrastructure\Response\ApiHttpCreatedResponse;
use CodelyTv\Context\Video\Module\Review\Application\Create\CreateVideoReviewCommand;
use CodelyTv\Types\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\Request;

final class VideoReviewPostController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke($videoId, Request $request)
    {
        $command = new CreateVideoReviewCommand(
            new Uuid($request->get('request_id')),
            $request->get('id'),
            $videoId,
            (int) $request->get('rating'),
            $request->get('text')
        );

        $this->dispatch($command);

        return new ApiHttpCreatedResponse();
    }
}
