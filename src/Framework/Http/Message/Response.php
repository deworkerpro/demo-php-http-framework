<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use LogicException;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

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

    /**
     * @return array<string, string[]>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader($name): array
    {
        return $this->headers[$name] ?? [];
    }

    public function withHeader($name, $value): ResponseInterface
    {
        $clone = clone $this;
        $clone->headers[$name] = (array)$value;
        return $clone;
    }

    public function withAddedHeader($name, $value): ResponseInterface
    {
        $clone = clone $this;
        $clone->headers[$name] = array_merge_recursive($clone->headers[$name], (array)$value);
        return $clone;
    }

    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body): ResponseInterface
    {
        $clone = clone $this;
        $clone->body = $body;
        return $clone;
    }

    public function getProtocolVersion(): string
    {
        throw new LogicException('Not implemented.');
    }

    public function withProtocolVersion($version): ResponseInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function hasHeader($name): void
    {
        throw new LogicException('Not implemented.');
    }

    public function getHeaderLine($name): string
    {
        throw new LogicException('Not implemented.');
    }

    public function withoutHeader($name): ResponseInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function getReasonPhrase(): string
    {
        throw new LogicException('Not implemented.');
    }
}
