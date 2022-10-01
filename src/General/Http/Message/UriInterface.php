<?php

declare(strict_types=1);

namespace General\Http\Message;

interface UriInterface
{
    public function getScheme(): string;

    public function getUserInfo(): string;

    public function getHost(): string;

    public function getPort(): ?int;

    public function getPath(): string;

    public function getQuery(): string;

    public function getFragment(): string;

    public function __toString(): string;
}
