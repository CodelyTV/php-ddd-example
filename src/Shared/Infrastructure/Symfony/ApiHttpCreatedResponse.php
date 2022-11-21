<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Symfony;

use Symfony\Component\HttpFoundation\Response;

final class ApiHttpCreatedResponse
{
    public function __construct()
    {
        return new Response('Row(s) has been created.', Response::HTTP_CREATED);
    }
}