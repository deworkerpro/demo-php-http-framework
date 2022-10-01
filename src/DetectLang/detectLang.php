<?php

declare(strict_types=1);

namespace DetectLang;

use Psr\Http\Message\ServerRequestInterface;

function detectLang(ServerRequestInterface $request, string $default): string
{
    if (!empty($request->getQueryParams()['lang']) && is_string($request->getQueryParams()['lang'])) {
        return (string)$request->getQueryParams()['lang'];
    }

    if (!empty($request->getCookieParams()['lang'])) {
        return (string)$request->getCookieParams()['lang'];
    }

    if ($request->hasHeader('Accept-Language')) {
        return substr($request->getHeaderLine('Accept-Language'), 0, 2);
    }

    return $default;
}
