<?php


namespace CodelyTv\Shared\Infrastructure;


use mikemccabe\JsonPatch\JsonPatch;
use mikemccabe\JsonPatch\JsonPatchException;

class PatchParser
{
    const EXECUTION_SECTION_KEY = 'execution';
    const QUERY_SECTION_KEY = 'query';

    const VALUE_KEY = '/value';
    const PATH_KEY = '/path';
    const OP_KEY = '/op';

    public final static function parse(array $patch, array $supportedPatches): ?callable
    {
        try {
            $patchValue = JsonPatch::get($patch, static::VALUE_KEY);
            $patchPath = JsonPatch::get($patch, static::PATH_KEY);
            $patchOp = JsonPatch::get($patch, static::OP_KEY);
        } catch (JsonPatchException $e) {
            return null;
        }

        $patchToBeCalled = array_filter(
            $supportedPatches,
            function($supportPatch) use($patchValue, $patchPath, $patchOp) {
                if ($supportPatch[static::QUERY_SECTION_KEY][static::PATH_KEY] !== $patchPath) {
                    return false;
                }

                if ($supportPatch[static::QUERY_SECTION_KEY][static::OP_KEY] !== $patchOp) {
                    return false;
                }

                if (!preg_match($supportPatch[static::QUERY_SECTION_KEY][static::VALUE_KEY], $patchValue)) {
                    return false;
                }

                return true;
            });

        if (count($patchToBeCalled) !== 1) {
            return null;
        }

        return function($id)  use ($patchValue, $patchToBeCalled) {
            $patchToBeCalled[0]['execution']($id, $patchValue);
        };
    }
}