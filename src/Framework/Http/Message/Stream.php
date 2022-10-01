<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use LogicException;
use Psr\Http\Message\StreamInterface;

final class Stream implements StreamInterface
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * @param resource $resource
     */
    public function __construct(mixed $resource)
    {
        $this->resource = $resource;
    }

    public function seek($offset, $whence = SEEK_SET): void
    {
        fseek($this->resource, $offset, $whence);
    }

    public function rewind(): void
    {
        $this->seek(0);
    }

    public function read($length): string
    {
        return fread($this->resource, $length);
    }

    public function write($string): void
    {
        fwrite($this->resource, $string);
    }

    public function getContents(): string
    {
        return stream_get_contents($this->resource);
    }

    public function __toString(): string
    {
        $this->rewind();
        return $this->getContents();
    }

    public function close(): void
    {
        throw new LogicException('Not implemented.');
    }

    public function detach(): void
    {
        throw new LogicException('Not implemented.');
    }

    public function getSize(): ?int
    {
        throw new LogicException('Not implemented.');
    }

    public function tell(): int
    {
        throw new LogicException('Not implemented.');
    }

    public function eof(): bool
    {
        throw new LogicException('Not implemented.');
    }

    public function isSeekable(): bool
    {
        throw new LogicException('Not implemented.');
    }

    public function isWritable(): bool
    {
        throw new LogicException('Not implemented.');
    }

    public function isReadable(): bool
    {
        throw new LogicException('Not implemented.');
    }

    public function getMetadata($key = null): mixed
    {
        throw new LogicException('Not implemented.');
    }
}
