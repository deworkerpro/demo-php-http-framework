<?php

declare(strict_types=1);

use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\TextResponse;
use Laminas\HttpHandlerRunner\Emitter\SapiStreamEmitter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function App\detectLang;
use function Framework\Http\createServerRequestFromGlobals;

http_response_code(500);

/** @psalm-suppress MissingFile */
require __DIR__ . '/../vendor/autoload.php';

### Page

function home(ServerRequestInterface $request): ResponseInterface
{
    $name = $request->getQueryParams()['name'] ?? 'Guest';

    if (!is_string($name)) {
        return new EmptyResponse(400);
    }

    $lang = detectLang($request, 'en');

    return new TextResponse('Hello, ' . $name . '! Your lang is ' . $lang);
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

$emitter = new SapiStreamEmitter();
$emitter->emit($response);
