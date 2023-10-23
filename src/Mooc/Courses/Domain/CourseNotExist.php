<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\DomainError;

final class CourseNotExist extends DomainError
{
	public function __construct(private readonly CourseId $id)
	{
		parent::__construct();
	}

	public function errorCode(): string
	{
		return 'course_not_exist';
	}

	protected function errorMessage(): string
	{
		return sprintf('The course <%s> does not exist', $this->id->value());
	}
}
