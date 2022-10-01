<?php

declare(strict_types=1);

namespace Framework\Http\Message;

final class Response
{
    private int $statusCode;
    private Stream $body;
    private array $headers;

    public function __construct(int $statusCode = 200, ?Stream $body = null, array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->body = $body ?? new Stream(fopen('php://memory', 'r+'));
        $this->headers = $headers;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function withHeader(string $name, string $value): self
    {
        $clone = clone $this;
        $clone->headers[$name] = $value;
        return $clone;
    }

    public function getBody(): Stream
    {
        return $this->body;
    }
}
