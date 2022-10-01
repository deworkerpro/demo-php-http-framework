<?php

declare(strict_types=1);

namespace Framework\Http\Message;

final class ServerRequest
{
    public function __construct(
        public readonly array $serverParams,
        public readonly string $uri,
        public readonly string $method,
        public readonly array $queryParams,
        public readonly array $headers,
        public readonly array $cookieParams,
        public readonly string $body,
        public readonly ?array $parsedBody
    ) {
    }
}
