<?php

declare(strict_types=1);

namespace App;

use DetectLang\LangRequest;
use Framework\Http\Message\ServerRequest;

final class LangServerRequestAdapter implements LangRequest
{
    private readonly ServerRequest $origin;

    public function __construct(ServerRequest $origin)
    {
        $this->origin = $origin;
    }

    public function getQueryParams(): array
    {
        return $this->origin->getQueryParams();
    }

    public function getCookieParams(): array
    {
        return $this->origin->getCookieParams();
    }

    public function hasHeader(string $name): bool
    {
        return $this->origin->hasHeader($name);
    }

    public function getHeaderLine(string $name): string
    {
        return $this->origin->getHeaderLine($name);
    }
}
