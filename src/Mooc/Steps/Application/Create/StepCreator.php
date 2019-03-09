<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Application\Create;

use CodelyTv\Mooc\Steps\Domain\StepRepository;
use CodelyTv\Mooc\Videos\Domain\VideoId;

final class StepCreator
{
    private $repository;

    public function __construct(StepRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(VideoId $id): void
    {
        //        $this->repository->save()
    }
}
