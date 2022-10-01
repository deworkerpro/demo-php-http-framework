<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use General\Http\Message\ServerRequestInterface;
use General\Http\Message\StreamInterface;
use General\Http\Message\UriInterface;

final class ServerRequest implements ServerRequestInterface
{
    private array $serverParams;
    private UriInterface $uri;
    private string $method;
    private array $queryParams;
    /**
     * @var array<string, string[]>
     */
    private array $headers;
    private array $cookieParams;
    private StreamInterface $body;
    private ?array $parsedBody;

    /**
     * @param array<string, string[]> $headers
     */
    public function __construct(
        array $serverParams,
        UriInterface $uri,
        string $method,
        array $queryParams,
        array $headers,
        array $cookieParams,
        StreamInterface $body,
        ?array $parsedBody
    ) {
        $this->serverParams = $serverParams;
        $this->uri = $uri;
        $this->method = $method;
        $this->queryParams = $queryParams;
        $this->headers = $headers;
        $this->cookieParams = $cookieParams;
        $this->body = $body;
        $this->parsedBody = $parsedBody;
    }

    public function getServerParams(): array
    {
        return $this->serverParams;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * @return array<string, string[]>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function hasHeader(string $name): bool
    {
        return array_key_exists($name, $this->headers);
    }

    public function getHeaderLine(string $name): string
    {
        return implode(', ', $this->headers[$name] ?? []);
    }

    public function getCookieParams(): array
    {
        return $this->cookieParams;
    }

    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    public function getParsedBody(): ?array
    {
        return $this->parsedBody;
    }

    public function withParsedBody(?array $parsedBody): self
    {
        $clone = clone $this;
        $clone->parsedBody = $parsedBody;
        return $clone;
    }
}
