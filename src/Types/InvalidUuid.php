<?php

declare (strict_types = 1);

namespace CodelyTv\Types;

use CodelyTv\Exception\DomainError;

final class InvalidUuid extends DomainError
{
    private $uuid;

    public function __construct(string $uuid)
    {
        parent::__construct();

        $this->uuid = $uuid;
    }

    public function errorCode(): string
    {
        return 'invalid_uuid';
    }

    protected function errorMessage(): string
    {
        return sprintf('The <%s> is an invalid uuid', $this->uuid);
    }
}
