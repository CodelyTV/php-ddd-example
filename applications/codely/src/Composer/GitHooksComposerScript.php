<?php

namespace CodelyTv\Composer;

final class GitHooksComposerScript
{
    public static function install()
    {
        exec('applications/codely/bin/console codely:codely:git-hooks install');
    }
}
