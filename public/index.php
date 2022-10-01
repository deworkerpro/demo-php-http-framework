<?php

declare(strict_types=1);

use Framework\Http\Message\Response;
use Framework\Http\Message\ServerRequest;

use function App\detectLang;
use function Framework\Http\createServerRequestFromGlobals;

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

http_response_code($response->getStatusCode());

/**
 * @var string $name
 * @var string $value
 */
foreach ($response->getHeaders() as $name => $value) {
    header($name . ': ' . $value);
}

echo $response->getBody();
