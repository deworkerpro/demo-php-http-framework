<?php

declare(strict_types=1);

namespace Test\Framework\Http\Message;

use Framework\Http\Message\Response;
use Framework\Http\Message\Stream;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ResponseTest extends TestCase
{
    public function testCreate(): void
    {
        $response = new Response(
            $status = 200,
            $body = new Stream(fopen('php://memory', 'r+')),
            $headers = [
                'Header-1' => 'value-1',
                'Header-2' => 'value-2',
            ]
        );

        self::assertEquals($body, $response->getBody());
        self::assertEquals($status, $response->getStatusCode());
        self::assertEquals($headers, $response->getHeaders());
    }

    public function testHeader(): void
    {
        $response = new Response();

        $response = $response
            ->withHeader('Header-1', 'value-1')
            ->withHeader('Header-2', 'value-2');

        self::assertEquals([
            'Header-1' => 'value-1',
            'Header-2' => 'value-2',
        ], $response->getHeaders());
    }
}
