<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use Laminas\Diactoros\Uri;
use Psr\Http\Message\UriInterface;

final class DiactorosUriFactory
{
    public function createUri(string $uri = ''): UriInterface
    {
        return new Uri($uri);
    }
}
