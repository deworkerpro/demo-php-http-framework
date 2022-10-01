<?php

declare(strict_types=1);

use Framework\Http\Message\Response;
use Framework\Http\Message\ServerRequest;

use function App\detectLang;
use function Framework\Http\createServerRequestFromGlobals;
use function Framework\Http\emitResponseToSapi;

http_response_code(500);

/** @psalm-suppress MissingFile */
require __DIR__ . '/../vendor/autoload.php';

### Page

function home(ServerRequest $request): Response
{
    $name = $request->getQueryParams()['name'] ?? 'Guest';

    if (!is_string($name)) {
        return new Response(400, '', []);
    }

    $lang = detectLang($request, 'en');

    return new Response(
        200,
        'Hello, ' . $name . '! Your lang is ' . $lang,
        [
            'Content-Type' => 'text/plain; charset=utf-8',
            'X-Frame-Options' => 'DENY',
        ]
    );
}

### Grabbing

$request = createServerRequestFromGlobals();

### Running

$response = home($request);

### Sending

emitResponseToSapi($response);
