<?php

declare(strict_types=1);

namespace General\Http\Message;

use Psr\Http\Message\UriInterface;

interface UriFactoryInterface
{
    public function createUri(string $uri = ''): UriInterface;
}
