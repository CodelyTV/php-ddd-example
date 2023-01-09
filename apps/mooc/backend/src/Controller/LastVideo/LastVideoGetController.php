<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\LastVideo;

use CodelyTv\Mooc\LastVideo\Application\Find\LastVideoResponse;
use CodelyTv\Mooc\LastVideo\Application\Find\FindLastVideoQuery;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoNotExist;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class LastVideoGetController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        /** @var LastVideoResponse $response */
        $response = $this->ask(new FindLastVideoQuery());

        return new JsonResponse(
            [
                'id' => $response->id(),
                'type' => $response->type(),
                'title' => $response->title(),
                'url' => $response->url(),
                'courseId' => $response->courseId(),

            ]
        );
    }

    protected function exceptions(): array
    {
        return [
            LastVideoNotExist::class => Response::HTTP_NOT_FOUND,
        ];
    }
}
