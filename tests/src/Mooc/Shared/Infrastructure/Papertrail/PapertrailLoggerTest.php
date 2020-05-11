<?php


namespace CodelyTv\Tests\Mooc\Shared\Infrastructure\Papertrail;


use CodelyTv\Mooc\Shared\Domain\LogLevel;
use CodelyTv\Mooc\Shared\Infrastructure\EnvironmentVariablesLoggerFactory;
use CodelyTv\Mooc\Shared\Infrastructure\Papertrail\PapertrailLogger;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

class PapertrailLoggerTest extends InfrastructureTestCase
{
    private ?PapertrailLogger $logger;

    protected function setUp(): void
    {
        parent::setUp();

        $factory = new EnvironmentVariablesLoggerFactory();
        $this->logger = $factory->createPapertrailLogger();
    }

    /** @test */
    public function it_should_log_a_test_message(): void
    {
        if($this->logger === null){
            $this->fail("Papertrail logger is not configured");
        }

        $this->logger->log(LogLevel::ALERT, "Test Message!");
        $this->assertTrue(true, "Alert logged to Papertrail successfully!");
    }
}