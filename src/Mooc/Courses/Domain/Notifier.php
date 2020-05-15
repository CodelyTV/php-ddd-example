<?php


namespace CodelyTv\Mooc\Courses\Domain;


interface Notifier
{
    public function publish(array $params): void;
}