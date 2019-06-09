<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\Video;

use CodelyTv\Mooc\Videos\Application\Remove\RemoveVideoCommand;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpCreatedResponse;
use Symfony\Component\HttpFoundation\Request;

class VideoRemoveController extends ApiController
{

	protected function exceptions(): array
	{

	}

	public function __invoke(Request $request)
	{
		var_dump('entro');die;
		$command = new RemoveVideoCommand(
			new Uuid($request->get('request_id')),
			$request->get('id')
		);

		$this->dispatch($command);

		return new ApiHttpCreatedResponse();

	}
}