<?php

namespace CodelyTv\Apps\Backoffice\Backend\Controller\Courses;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LastVideoController
{
    public function __construct(private QueryHandler $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->queryBus->__invoke()
        );
    }
}
