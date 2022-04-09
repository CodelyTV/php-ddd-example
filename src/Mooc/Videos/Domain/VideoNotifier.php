<?php

declare(strict_types=1);

interface VideoNotifier
{
    public function save(String $message): void;
}
