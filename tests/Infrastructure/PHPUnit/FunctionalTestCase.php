<?php

namespace CodelyTv\Test\Infrastructure\PHPUnit;

use CodelyTv\Api\ApiKernel;
use CodelyTv\CodelyKernel;

abstract class FunctionalTestCase extends UnitTestCase
{
    /** @var ApiKernel */
    private $kernel;

    protected function setUp()
    {
        parent::setUp();

        $this->kernel()->boot();
    }

    protected function service($id)
    {
        return $this->container()->get($id);
    }

    protected function parameter($parameter)
    {
        return $this->container()->getParameter($parameter);
    }

    private function kernel()
    {
        return $this->kernel = $this->kernel ?: new CodelyKernel('test', true);
    }

    private function container()
    {
        return $this->kernel()->getContainer();
    }
}
