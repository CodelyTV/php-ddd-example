<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

use function Lambdish\Phunctional\apply;

final readonly class FindVideoQueryHandler implements QueryHandler
{
	private VideoResponseConverter $responseConverter;

	public function __construct(private VideoFinder $finder)
	{
		$this->responseConverter = new VideoResponseConverter();
	}

	public function __invoke(FindVideoQuery $query): VideoResponse
	{
		$id = new VideoId($query->id());

		$video = apply($this->finder, [$id]);

		return apply($this->responseConverter, [$video]);
	}
}
