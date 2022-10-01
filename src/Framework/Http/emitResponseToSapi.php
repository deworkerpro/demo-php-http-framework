<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Http\Message\Response;

function emitResponseToSapi(Response $response): void
{
    http_response_code($response->getStatusCode());

    /**
     * @var string $name
     * @var string $value
     */
    foreach ($response->getHeaders() as $name => $value) {
        header($name . ': ' . $value);
    }

    echo $response->getBody();
}