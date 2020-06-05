<?php


namespace CodelyTv\Shared\Infrastructure;


use mikemccabe\JsonPatch\JsonPatch;

class PatchParser
{
    public final static function parse(array $patch, array $supportedPatches): ?callable {
        $value = JsonPatch::get($patch, '/value');
        return function($id)  use ($value, $supportedPatches) {
            $supportedPatches[0]['execution']($id, $value);
        } ;
//        if (JsonPatch::get($patch, '/op') == 'replace') {
//            if (JsonPatch::get($patch, '/path') == '/name') {
//                $this->dispatch(
//                    new CourseRenamerCommand(
//                        $id,
//                        JsonPatch::get($patch, '/value')
//                    )
//                );
//                // todo continue here
//                return new Response('', Response::HTTP_OK);
//            }
//
//        }
    }
}