<?php

declare(strict_types=1);

namespace DetectLang;

interface LangRequest
{
    public function getQueryParams(): array;
    public function hasHeader(string $name): bool;
    public function getHeaderLine(string $name): string;
    public function getCookieParams(): array;
}
