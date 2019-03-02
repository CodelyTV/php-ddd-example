<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Mink;

final class MinkSessionResponseHelper
{
    /** @var MinkHelper */
    private $sessionHelper;

    public function __construct($sessionHelper)
    {
        $this->sessionHelper = $sessionHelper;
    }

    public function getResponse(): string
    {
        return $this->sessionHelper->getResponse();
    }
}
