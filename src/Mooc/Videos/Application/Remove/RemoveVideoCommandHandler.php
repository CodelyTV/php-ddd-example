<?php
declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Remove;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class RemoveVideoCommandHandler implements CommandHandler
{
	private $remover;

	public function __construct(VideoRemover $remover)
	{
		$this->remover = $remover;
	}

	public function __invoke(RemoveVideoCommand $command)
	{
		$id = new VideoId($command->id());

		$this->remover->remove($id);
	}
}