<?php

declare(strict_types=1);

namespace Test\Framework\Http\Message;

use Framework\Http\Message\ServerRequest;
use Framework\Http\Message\Stream;
use Framework\Http\Message\Uri;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ServerRequestTest extends TestCase
{
    public function testCreate(): void
    {
        $request = new ServerRequest(
            serverParams: $serverParams = ['HOST' => 'app.test'],
            uri: $uri = new Uri('/home'),
            method: $method = 'GET',
            queryParams: $queryParams = ['name' => 'John'],
            headers: $headers = ['X-Header' => 'Value'],
            cookieParams: $cookieParams = ['Cookie' => 'Val'],
            body: $body = new Stream(fopen('php://memory', 'r')),
            parsedBody: $parsedBody = ['title' => 'Title']
        );

        self::assertEquals($serverParams, $request->getServerParams());
        self::assertEquals($uri, $request->getUri());
        self::assertEquals($method, $request->getMethod());
        self::assertEquals($queryParams, $request->getQueryParams());
        self::assertEquals($headers, $request->getHeaders());
        self::assertEquals($cookieParams, $request->getCookieParams());
        self::assertEquals($body, $request->getBody());
        self::assertEquals($parsedBody, $request->getParsedBody());
    }
}
