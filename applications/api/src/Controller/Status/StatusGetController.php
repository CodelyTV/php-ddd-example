<?php

declare(strict_types = 1);

namespace CodelyTv\Api\Controller\Status;

use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpOkResponse;

final class StatusGetController
{
    public function __invoke()
    {
        return new ApiHttpOkResponse(['status' => 'OK']);
    }
}
