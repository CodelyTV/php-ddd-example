<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Backoffice\Frontend\Controller\Home;

use CodelyTv\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HomeGetWebController extends WebController
{
	public function __invoke(Request $request): Response
	{
		return $this->render('pages/home.html.twig', [
			'title' => 'Welcome',
			'description' => 'CodelyTV - Backoffice',
		]);
	}

	protected function exceptions(): array
	{
		return [];
	}
}
