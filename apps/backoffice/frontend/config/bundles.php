<?php

$bundles = [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class                              => ['all' => true],
    FriendsOfBehat\SymfonyExtension\Bundle\FriendsOfBehatSymfonyExtensionBundle::class => ['test' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class                                        => ['all' => true],
];

$suggestedBundles = [];

if (true) {
    $suggestedBundles[WouterJ\EloquentBundle\WouterJEloquentBundle::class] = ['test' => true];
}

return array_merge($bundles, $suggestedBundles);
