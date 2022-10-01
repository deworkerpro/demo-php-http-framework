<?php

declare(strict_types=1);

namespace General\Http\Message;

interface StreamInterface
{
    public function seek(int $offset): void;

    public function rewind(): void;

    public function read(int $length): string;

    public function write(string $data): void;

    public function getContents(): string;

    public function __toString(): string;
}
