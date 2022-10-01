<?php

declare(strict_types=1);

use Framework\Http\Message\ServerRequest;

use function App\detectLang;
use function Framework\Http\createServerRequestFromGlobals;

http_response_code(500);

/** @psalm-suppress MissingFile */
require __DIR__ . '/../vendor/autoload.php';

### Page

/**
 * @return array{statusCode: int, body: string, headers: array<string, string>}
 */
function home(ServerRequest $request): array
{
    $name = $request->getQueryParams()['name'] ?? 'Guest';

    if (!is_string($name)) {
        return [
            'statusCode' => 400,
            'body' => '',
            'headers' => [],
        ];
    }

    $lang = detectLang($request, 'en');

    return [
        'statusCode' => 200,
        'body' => 'Hello, ' . $name . '! Your lang is ' . $lang,
        'headers' => [
            'Content-Type' => 'text/plain; charset=utf-8',
            'X-Frame-Options' => 'DENY',
        ],
    ];
}

### Grabbing

$request = createServerRequestFromGlobals();

### Running

$response = home($request);

### Sending

http_response_code($response['statusCode']);

foreach ($response['headers'] as $name => $value) {
    header($name . ': ' . $value);
}

echo $response['body'];
