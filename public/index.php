<?php

declare(strict_types=1);

use Framework\Http\Message\ServerRequest;

use function Framework\Http\createServerRequestFromGlobals;

http_response_code(500);

/** @psalm-suppress MissingFile */
require __DIR__ . '/../vendor/autoload.php';

function detectLang(ServerRequest $request, string $default): string
{
    if (!empty($request->getQueryParams()['lang']) && is_string($request->getQueryParams()['lang'])) {
        return $request->getQueryParams()['lang'];
    }

    if (!empty($request->getParsedBody()['lang']) && is_string($request->getParsedBody()['lang'])) {
        return $request->getParsedBody()['lang'];
    }

    if (!empty($request->getCookieParams()['lang'])) {
        return (string)$request->getCookieParams()['lang'];
    }

    if (!empty($request->getHeaders()['Accept-Language'])) {
        return substr((string)$request->getHeaders()['Accept-Language'], 0, 2);
    }

    return $default;
}

$request = createServerRequestFromGlobals();

$name = $request->getQueryParams()['name'] ?? 'Guest';

if (!is_string($name)) {
    http_response_code(400);
    exit;
}

$lang = detectLang($request, 'en');

http_response_code(200);
header('Content-Type: text/plain; charset=utf-8');
header('X-Frame-Options: DENY');
echo 'Hello, ' . $name . '! Your lang is ' . $lang;
