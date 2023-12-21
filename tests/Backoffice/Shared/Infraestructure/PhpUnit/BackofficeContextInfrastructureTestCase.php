<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Shared\Infraestructure\PhpUnit;

use CodelyTv\Apps\Backoffice\Backend\BackofficeBackendKernel;
use CodelyTv\Shared\Infrastructure\Elasticsearch\ElasticsearchClient;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManager;
use Override;

abstract class BackofficeContextInfrastructureTestCase extends InfrastructureTestCase
{
	#[Override]
	protected function setUp(): void
	{
		parent::setUp();

		$arranger = new BackofficeEnvironmentArranger(
			$this->service(ElasticsearchClient::class),
			$this->service(EntityManager::class)
		);

		$arranger->arrange();
	}

	#[Override]
	protected function kernelClass(): string
	{
		return BackofficeBackendKernel::class;
	}
}
