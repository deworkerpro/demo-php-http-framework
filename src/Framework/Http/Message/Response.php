<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use General\Http\Message\ResponseInterface;
use General\Http\Message\StreamInterface;

final class Response implements ResponseInterface
{
    private int $statusCode;
    private StreamInterface $body;
    /**
     * @var array<string, string[]>
     */
    private array $headers;

    /**
     * @param array<string, string[]> $headers
     */
    public function __construct(int $statusCode = 200, ?StreamInterface $body = null, array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->body = $body ?? new Stream(fopen('php://memory', 'r+'));
        $this->headers = $headers;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function withStatusCode(int $code): ResponseInterface
    {
        $new = clone $this;
        $new->statusCode = $code;
        return $new;
    }

    /**
     * @return array<string, string[]>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $name): array
    {
        return $this->headers[$name] ?? [];
    }

    public function withHeader(string $name, string $value): ResponseInterface
    {
        $clone = clone $this;
        $clone->headers[$name] = [$value];
        return $clone;
    }

    public function withAddedHeader(string $name, string $value): ResponseInterface
    {
        $clone = clone $this;
        $clone->headers[$name][] = $value;
        return $clone;
    }

    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body): ResponseInterface
    {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }
}
