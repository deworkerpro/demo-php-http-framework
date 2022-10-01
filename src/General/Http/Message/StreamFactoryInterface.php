<?php

declare(strict_types=1);

namespace General\Http\Message;

use Psr\Http\Message\StreamInterface;

interface StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface;

    /**
     * @param resource $resource
     */
    public function createStreamFromResource(mixed $resource): StreamInterface;
}
