<?php

declare(strict_types=1);

namespace Test\App;

use App\LangServerRequestAdapter;
use Framework\Http\Message\ServerRequest;
use Framework\Http\Message\Stream;
use Framework\Http\Message\Uri;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class LangServerRequestAdapterTest extends TestCase
{
    public function testAdapter(): void
    {
        $request = new ServerRequest(
            serverParams: [],
            uri: new Uri('/home'),
            method: 'GET',
            queryParams: $queryParams = ['name' => 'John'],
            headers: $headers = [
                'X-Header-1' => ['value-11', 'value-12'],
                'X-Header-2' => ['value-2'],
            ],
            cookieParams: $cookieParams = ['Cookie' => 'Val'],
            body: new Stream(fopen('php://memory', 'r')),
            parsedBody: []
        );

        $adapter = new LangServerRequestAdapter($request);

        self::assertEquals($queryParams, $adapter->getQueryParams());

        self::assertTrue($adapter->hasHeader('X-Header-1'));
        self::assertFalse($adapter->hasHeader('X-Header-3'));
        self::assertEquals('value-11, value-12', $adapter->getHeaderLine('X-Header-1'));
        self::assertEquals('value-2', $adapter->getHeaderLine('X-Header-2'));

        self::assertEquals($cookieParams, $adapter->getCookieParams());
    }
}
