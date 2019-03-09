<?php

use CodelyTv\Mooc\Shared\Infrastructure\Symfony\Bundle\CodelyTvMoocBundle;
use CodelyTv\Shared\Infrastructure\Symfony\Bundle\CodelyTvInfrastructureBundle;
use FOS\RestBundle\FOSRestBundle;
use FriendsOfBehat\SymfonyExtension\Bundle\FriendsOfBehatSymfonyExtensionBundle;
use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;

return [
    CodelyTvInfrastructureBundle::class  => ['all' => true],
    CodelyTvMoocBundle::class  => ['all' => true],

    FrameworkBundle::class  => ['all' => true],
    TwigBundle::class  => ['all' => true],

    MonologBundle::class  => ['all' => true],

    FOSRestBundle::class  => ['all' => true],
    JMSSerializerBundle::class  => ['all' => true],

    FriendsOfBehatSymfonyExtensionBundle::class => ['test' => true]
];

