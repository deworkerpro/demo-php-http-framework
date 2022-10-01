<?php

declare(strict_types=1);

namespace General\Http\Message;

interface ResponseInterface
{
    public function getStatusCode(): int;

    public function withStatusCode(int $code): ResponseInterface;

    /**
     * @return array<string, string[]>
     */
    public function getHeaders(): array;

    /**
     * @return string[]
     */
    public function getHeader(string $name): array;

    public function withHeader(string $name, string $value): ResponseInterface;

    public function withAddedHeader(string $name, string $value): ResponseInterface;

    public function getBody(): StreamInterface;

    public function withBody(StreamInterface $body): ResponseInterface;
}
