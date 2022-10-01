<?php

declare(strict_types=1);

use Framework\Http\Message\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function DetectLang\detectLang;
use function Framework\Http\createServerRequestFromGlobals;
use function Framework\Http\emitResponseToSapi;

http_response_code(500);

/** @psalm-suppress MissingFile */
require __DIR__ . '/../vendor/autoload.php';

### Page

function home(ServerRequestInterface $request): ResponseInterface
{
    $name = $request->getQueryParams()['name'] ?? 'Guest';

    if (!is_string($name)) {
        return new Response(400);
    }

    $lang = detectLang($request, 'en');

    $response = (new Response())
        ->withHeader('Content-Type', 'text/plain; charset=utf-8');

    $response->getBody()->write('Hello, ' . $name . '! Your lang is ' . $lang);

    return $response;
}

### Grabbing

$request = createServerRequestFromGlobals();

### Preprocessing

if (str_starts_with($request->getHeaderLine('Content-Type'), 'application/x-www-form-urlencoded')) {
    parse_str((string)$request->getBody(), $data);
    $request = $request->withParsedBody($data);
}

### Running

$response = home($request);

### Postprocessing

$response = $response->withHeader('X-Frame-Options', 'DENY');

### Sending

emitResponseToSapi($response);
