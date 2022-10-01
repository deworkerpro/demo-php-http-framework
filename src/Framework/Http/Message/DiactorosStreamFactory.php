<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use General\Http\Message\StreamFactoryInterface;
use Laminas\Diactoros\Stream;
use Psr\Http\Message\StreamInterface;

final class DiactorosStreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        $resource = fopen('php://temp', 'r+');
        fwrite($resource, $content);
        rewind($resource);

        return new Stream($resource);
    }

    /**
     * @param resource $resource
     */
    public function createStreamFromResource(mixed $resource): StreamInterface
    {
        return new Stream($resource);
    }
}
