<?php

declare(strict_types=1);

use Laminas\Diactoros\Response;
use Laminas\HttpHandlerRunner\Emitter\SapiStreamEmitter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function App\detectLang;
use function Framework\Http\createServerRequestFromGlobals;

http_response_code(500);

/** @psalm-suppress MissingFile */
require __DIR__ . '/../vendor/autoload.php';

### Page

final class Home
{
    private readonly Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $name = $request->getQueryParams()['name'] ?? 'Guest';

        if (!is_string($name)) {
            return $this->response->withStatus(400);
        }

        $lang = detectLang($request, 'en');

        $response = $this->response
            ->withHeader('Content-Type', 'text/plain; charset=utf-8');

        $response->getBody()->write('Hello, ' . $name . '! Your lang is ' . $lang);

        return $response;
    }
}

### Grabbing

$request = createServerRequestFromGlobals();

### Preprocessing

if (str_starts_with($request->getHeaderLine('Content-Type'), 'application/x-www-form-urlencoded')) {
    parse_str((string)$request->getBody(), $data);
    $request = $request->withParsedBody($data);
}

### Running

$home = new Home(new Response());

$response = $home($request);

### Postprocessing

$response = $response->withHeader('X-Frame-Options', 'DENY');

### Sending

$emitter = new SapiStreamEmitter();
$emitter->emit($response);
