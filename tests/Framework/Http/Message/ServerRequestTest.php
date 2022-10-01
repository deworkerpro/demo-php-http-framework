<?php

declare(strict_types=1);

namespace Test\Framework\Http\Message;

use Framework\Http\Message\ServerRequest;
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
            uri: $uri = '/home',
            method: $method = 'GET',
            queryParams: $queryParams = ['name' => 'John'],
            headers: $headers = ['X-Header' => 'Value'],
            cookieParams: $cookieParams = ['Cookie' => 'Val'],
            body: $body = 'body',
            parsedBody: $parsedBody = ['title' => 'Title']
        );

        self::assertEquals($serverParams, $request->serverParams);
        self::assertEquals($uri, $request->uri);
        self::assertEquals($method, $request->method);
        self::assertEquals($queryParams, $request->queryParams);
        self::assertEquals($headers, $request->headers);
        self::assertEquals($cookieParams, $request->cookieParams);
        self::assertEquals($body, $request->body);
        self::assertEquals($parsedBody, $request->parsedBody);
    }
}
