<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use General\Http\Message\ResponseFactoryInterface;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;

final class DiactorosResponseFactory implements ResponseFactoryInterface
{
    public function createResponse(int $code = 200): ResponseInterface
    {
        return new Response((new DiactorosStreamFactory())->createStream(), $code, []);
    }
}
