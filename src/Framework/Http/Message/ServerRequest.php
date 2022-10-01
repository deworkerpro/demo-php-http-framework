<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use LogicException;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

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
    private array|object|null $parsedBody;

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

    public function hasHeader($name): bool
    {
        return array_key_exists($name, $this->headers);
    }

    public function getHeaderLine($name): string
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

    public function getParsedBody(): array|object|null
    {
        return $this->parsedBody;
    }

    public function withParsedBody($data): ServerRequestInterface
    {
        $clone = clone $this;
        $clone->parsedBody = $data;
        return $clone;
    }

    public function getProtocolVersion(): string
    {
        throw new LogicException('Not implemented.');
    }

    public function withProtocolVersion($version): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function getHeader($name): array
    {
        throw new LogicException('Not implemented.');
    }

    public function withHeader($name, $value): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withAddedHeader($name, $value): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withoutHeader($name): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withBody(StreamInterface $body): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function getRequestTarget(): string
    {
        throw new LogicException('Not implemented.');
    }

    public function withRequestTarget($requestTarget): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withMethod($method): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withUri(UriInterface $uri, $preserveHost = false): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withQueryParams(array $query): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function getUploadedFiles(): array
    {
        throw new LogicException('Not implemented.');
    }

    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function getAttributes(): array
    {
        throw new LogicException('Not implemented.');
    }

    public function getAttribute($name, $default = null): mixed
    {
        throw new LogicException('Not implemented.');
    }

    public function withAttribute($name, $value): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }

    public function withoutAttribute($name): ServerRequestInterface
    {
        throw new LogicException('Not implemented.');
    }
}
