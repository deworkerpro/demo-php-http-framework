<?php

declare(strict_types=1);

namespace Framework\Http\Message;

final class ServerRequest
{
    private array $serverParams;
    private Uri $uri;
    private string $method;
    private array $queryParams;
    private array $headers;
    private array $cookieParams;
    private Stream $body;
    private ?array $parsedBody;

    public function __construct(
        array $serverParams,
        Uri $uri,
        string $method,
        array $queryParams,
        array $headers,
        array $cookieParams,
        Stream $body,
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

    public function getUri(): Uri
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

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getCookieParams(): array
    {
        return $this->cookieParams;
    }

    public function getBody(): Stream
    {
        return $this->body;
    }

    public function getParsedBody(): ?array
    {
        return $this->parsedBody;
    }
}
