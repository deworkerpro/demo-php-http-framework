<?php

declare(strict_types=1);

use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\TextResponse;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiStreamEmitter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function App\detectLang;

http_response_code(500);

/** @psalm-suppress MissingFile */
require __DIR__ . '/../vendor/autoload.php';

### Page

final class Home
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $name = $request->getQueryParams()['name'] ?? 'Guest';

        if (!is_string($name)) {
            return new EmptyResponse(400);
        }

        $lang = detectLang($request, 'en');

        return new TextResponse('Hello, ' . $name . '! Your lang is ' . $lang);
    }
}

### Grabbing

$request = ServerRequestFactory::fromGlobals();

### Preprocessing

if (str_starts_with($request->getHeaderLine('Content-Type'), 'application/x-www-form-urlencoded')) {
    parse_str((string)$request->getBody(), $data);
    $request = $request->withParsedBody($data);
}

### Running

$home = new Home();

$response = $home($request);

### Postprocessing

$response = $response->withHeader('X-Frame-Options', 'DENY');

### Sending

$emitter = new SapiStreamEmitter();
$emitter->emit($response);
