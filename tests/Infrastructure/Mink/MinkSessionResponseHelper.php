<?php

namespace CodelyTv\Test\Infrastructure\Mink;

final class MinkSessionResponseHelper
{
    /** @var MinkHelper */
    private $sessionHelper;

    public function __construct($sessionHelper)
    {
        $this->sessionHelper = $sessionHelper;
    }

    public function getResponse()
    {
        return $this->sessionHelper->getResponse();
    }
}
