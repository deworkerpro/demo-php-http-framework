<?php

declare(strict_types=1);

namespace Framework\Http\Message;

final class Stream
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

    public function seek(int $offset): void
    {
        fseek($this->resource, $offset);
    }

    public function rewind(): void
    {
        $this->seek(0);
    }

    public function read(int $length): string
    {
        return fread($this->resource, $length);
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
}
