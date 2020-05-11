<?php


namespace CodelyTv\Tests\Mooc\Shared\Infrastructure\Filesystem;


use CodelyTv\Mooc\Shared\Domain\LogLevel;
use CodelyTv\Mooc\Shared\Infrastructure\EnvironmentVariablesLoggerFactory;
use CodelyTv\Mooc\Shared\Infrastructure\Filesystem\FilesystemLogger;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

class FilesystemLoggerTest extends InfrastructureTestCase
{
    private ?FilesystemLogger $logger;

    protected function setUp(): void
    {
        parent::setUp();

        $factory = new EnvironmentVariablesLoggerFactory();
        $this->logger = $factory->createFilesystemLogger();
    }

    /** @test */
    public function it_should_log_a_test_message(): void
    {
        if($this->logger === null){
            $this->fail("Filesystem logger is not configured");
        }

        $this->logger->log(LogLevel::ALERT, "Test Message!");
        $this->assertTrue(true, "Alert logged to Filesystem successfully!");
    }
}