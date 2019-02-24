<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\Student;

use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpCreatedResponse;

final class StudentPutController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $id)
    {
        return new ApiHttpCreatedResponse();
    }
}
