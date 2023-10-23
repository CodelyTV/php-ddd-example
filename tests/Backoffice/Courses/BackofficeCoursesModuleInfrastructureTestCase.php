<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Courses;

use CodelyTv\Backoffice\Courses\Infrastructure\Persistence\ElasticsearchBackofficeCourseRepository;
use CodelyTv\Backoffice\Courses\Infrastructure\Persistence\MySqlBackofficeCourseRepository;
use CodelyTv\Tests\Backoffice\Shared\Infraestructure\PhpUnit\BackofficeContextInfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class BackofficeCoursesModuleInfrastructureTestCase extends BackofficeContextInfrastructureTestCase
{
	protected function mySqlRepository(): MySqlBackofficeCourseRepository
	{
		return new MySqlBackofficeCourseRepository($this->service(EntityManager::class));
	}

	protected function elasticRepository(): ElasticsearchBackofficeCourseRepository
	{
		return $this->service(ElasticsearchBackofficeCourseRepository::class);
	}
}
