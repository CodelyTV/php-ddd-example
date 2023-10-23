<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Backoffice\Frontend\Command;

use CodelyTv\Backoffice\Courses\Infrastructure\Persistence\ElasticsearchBackofficeCourseRepository;
use CodelyTv\Backoffice\Courses\Infrastructure\Persistence\MySqlBackofficeCourseRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ImportCoursesToElasticsearchCommand extends Command
{
	public function __construct(
		private readonly MySqlBackofficeCourseRepository $mySqlRepository,
		private readonly ElasticsearchBackofficeCourseRepository $elasticRepository
	) {
		parent::__construct();
	}

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$courses = $this->mySqlRepository->searchAll();

		foreach ($courses as $course) {
			$this->elasticRepository->save($course);
		}

		return 0;
	}
}
