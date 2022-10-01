<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use Psr\Http\Message\ResponseInterface;

function textResponse(ResponseInterface $response, string $content, int $status = 200): ResponseInterface
{
    $response = $response
        ->withStatus($status)
        ->withHeader('Content-Type', 'text/plain; charset=utf-8');

    $response->getBody()->write($content);

    return $response;
}
