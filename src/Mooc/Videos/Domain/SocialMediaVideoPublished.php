<?php

namespace CodelyTv\Mooc\Videos\Domain;

interface SocialMediaVideoPublished
{
    public function post(string $status);
}
