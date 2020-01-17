<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Symfony;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class AddJsonBodyToRequestListener
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request         = $event->getRequest();
        $requestContents = $request->getContent();

        if (!empty($requestContents) && $this->containsHeader($request, 'Content-Type', 'application/json')) {
            $jsonData = json_decode($requestContents, true);
            if (!$jsonData) {
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Invalid json data');
            }
            $jsonDataLowerCase = [];
            foreach ($jsonData as $key => $value) {
                $jsonDataLowerCase[preg_replace_callback(
                    '/_(.)/',
                    static function ($matches) {
                        return strtoupper($matches[1]);
                    },
                    $key
                )] = $value;
            }
            $request->request->replace($jsonDataLowerCase);
        }
    }

    private function containsHeader(Request $request, $name, $value): bool
    {
        return 0 === strpos($request->headers->get($name), $value);
    }
}
