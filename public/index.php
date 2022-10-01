<?php

declare(strict_types=1);

use Framework\Http\Message\DiactorosResponseFactory;
use Framework\Http\Message\DiactorosServerRequestFactory;
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
    private readonly DiactorosResponseFactory $factory;

    public function __construct(DiactorosResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $name = $request->getQueryParams()['name'] ?? 'Guest';

        if (!is_string($name)) {
            return $this->factory->createResponse(400);
        }

        $lang = detectLang($request, 'en');

        $response = $this->factory->createResponse()
            ->withHeader('Content-Type', 'text/plain; charset=utf-8');

        $response->getBody()->write('Hello, ' . $name . '! Your lang is ' . $lang);

        return $response;
    }
}

### Grabbing

$request = DiactorosServerRequestFactory::fromGlobals();

### Preprocessing

if (str_starts_with($request->getHeaderLine('Content-Type'), 'application/x-www-form-urlencoded')) {
    parse_str((string)$request->getBody(), $data);
    $request = $request->withParsedBody($data);
}

### Running

$home = new Home(new DiactorosResponseFactory());

$response = $home($request);

### Postprocessing

$response = $response->withHeader('X-Frame-Options', 'DENY');

### Sending

$emitter = new SapiStreamEmitter();
$emitter->emit($response);
