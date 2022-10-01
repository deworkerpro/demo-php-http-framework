<?php

declare(strict_types=1);

namespace Test\Framework\Http\Message;

use Framework\Http\Message\DiactorosServerRequestFactory;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class DiactorosServerRequestFactoryTest extends TestCase
{
    public function testFromGlobals(): void
    {
        $server = [
            'HTTP_HOST' => 'localhost',
            'REQUEST_URI' => '/home?a=2',
            'REQUEST_METHOD' => 'POST',
            'CONTENT_TYPE' => 'text/plain',
            'CONTENT_LENGTH' => '4',
            'HTTP_ACCEPT_LANGUAGE' => 'en',
        ];
        $query = ['param' => 'value'];
        $cookie = ['name' => 'John'];
        $body = ['age' => '42'];

        $input = fopen('php://memory', 'r+');
        fwrite($input, 'Body');

        $request = DiactorosServerRequestFactory::fromGlobals($server, $query, $cookie, $body, $input);

        self::assertEquals($server, $request->getServerParams());
        self::assertEquals('http://localhost/home?a=2', (string)$request->getUri());
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals($query, $request->getQueryParams());
        self::assertEquals([
            'Host' => ['localhost'],
            'Content-Type' => ['text/plain'],
            'Content-Length' => ['4'],
            'Accept-Language' => ['en'],
        ], $request->getHeaders());
        self::assertEquals($cookie, $request->getCookieParams());
        self::assertEquals('Body', (string)$request->getBody());
        self::assertEquals($body, $request->getParsedBody());
    }

    public function testDefault(): void
    {
        $factory = new DiactorosServerRequestFactory();

        $response = $factory->createServerRequest(
            $method = 'POST',
            $uri = '/',
            $serverParams = ['PARAM' => 'value']
        );

        self::assertEquals($method, $response->getMethod());
        self::assertEquals($uri, $response->getUri()->getPath());
        self::assertEquals($serverParams, $response->getServerParams());
    }
}
