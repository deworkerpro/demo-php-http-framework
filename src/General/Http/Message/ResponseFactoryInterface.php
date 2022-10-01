<?php

declare(strict_types=1);

namespace General\Http\Message;

use Psr\Http\Message\ResponseInterface;

interface ResponseFactoryInterface
{
    public function createResponse(int $code = 200): ResponseInterface;
}
