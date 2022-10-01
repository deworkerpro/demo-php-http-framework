<?php

declare(strict_types=1);

namespace General\Http\Message;

use Psr\Http\Message\ServerRequestInterface;

interface ServerRequestFactoryInterface
{
    public function createServerRequest(string $method, string $uri, array $serverParams = []): ServerRequestInterface;
}
