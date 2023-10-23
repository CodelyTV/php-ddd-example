<?php

declare(strict_types=1);

namespace CodelyTv\Analytics\DomainEvents\Domain;

interface DomainEventsRepository
{
	public function save(AnalyticsDomainEvent $event): void;
}
