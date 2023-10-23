<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Backoffice\Frontend\Controller\Metrics;

use CodelyTv\Shared\Infrastructure\Monitoring\PrometheusMonitor;
use Prometheus\RenderTextFormat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class MetricsController
{
	public function __construct(private PrometheusMonitor $monitor) {}

	public function __invoke(Request $request): Response
	{
		$renderer = new RenderTextFormat();
		$result = $renderer->render($this->monitor->registry()->getMetricFamilySamples());

		return new Response($result, 200, ['Content-Type' => RenderTextFormat::MIME_TYPE]);
	}
}
