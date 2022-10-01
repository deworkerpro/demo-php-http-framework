<?php

declare(strict_types=1);

namespace DetectLang;

final class LangRequest
{
    /**
     * @param array<string, string[]> $headers
     */
    public function __construct(
        private readonly array $queryParams,
        private readonly array $headers,
        private readonly array $cookieParams
    ) {
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
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
}
