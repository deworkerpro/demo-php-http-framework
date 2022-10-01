<?php

declare(strict_types=1);

namespace General\Http\Message;

interface ServerRequestInterface
{
    public function getServerParams(): array;

    public function getUri(): UriInterface;

    public function getMethod(): string;

    /**
     * @return array<string, string[]>
     */
    public function getHeaders(): array;

    public function hasHeader(string $name): bool;

    public function getHeaderLine(string $name): string;

    public function getCookieParams(): array;

    public function getQueryParams(): array;

    public function getBody(): StreamInterface;

    public function getParsedBody(): ?array;

    public function withParsedBody(?array $parsedBody): ServerRequestInterface;
}
