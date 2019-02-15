<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\Status;

use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpOkResponse;

final class StatusGetController
{
    public function __invoke()
    {
        return new ApiHttpOkResponse(['status' => 'OK']);
    }
}
