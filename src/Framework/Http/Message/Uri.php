<?php

declare(strict_types=1);

namespace Framework\Http\Message;

final class Uri
{
    private string $scheme;
    private string $host;
    private ?int $port;
    private string $user;
    private string $pass;
    private string $path;
    private string $query;
    private string $fragment;

    public function __construct(string $uri)
    {
        $data = parse_url($uri);

        $this->scheme = $data['scheme'] ?? '';
        $this->host = $data['host'] ?? '';
        $this->port = $data['port'] ?? null;
        $this->user = $data['user'] ?? '';
        $this->pass = $data['pass'] ?? '';
        $this->path = $data['path'] ?? '';
        $this->query = $data['query'] ?? '';
        $this->fragment = $data['fragment'] ?? '';
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getUserInfo(): string
    {
        return $this->user . ($this->pass !== '' ? ':' . $this->pass : '');
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getFragment(): string
    {
        return $this->fragment;
    }

    public function __toString(): string
    {
        return $this->scheme
            . '://'
            . ($this->getUserInfo() ? $this->getUserInfo() . '@' : '')
            . $this->host
            . ($this->port ? ':' . $this->port : '')
            . $this->path
            . ($this->query ? '?' . $this->query : '')
            . ($this->fragment ? '#' . $this->fragment : '');
    }
}
