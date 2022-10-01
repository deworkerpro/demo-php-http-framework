<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use Laminas\Diactoros\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

final class DiactorosServerRequestFactory
{
    public function createServerRequest(string $method, string $uri, array $serverParams = []): ServerRequestInterface
    {
        return new ServerRequest(
            serverParams: $serverParams,
            uri: (new DiactorosUriFactory())->createUri($uri),
            method: $method,
            body: (new DiactorosStreamFactory())->createStream(),
            headers: [],
            cookieParams: [],
            queryParams: [],
            parsedBody: null
        );
    }
}
