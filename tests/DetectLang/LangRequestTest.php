<?php

declare(strict_types=1);

namespace DetectLang;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class LangRequestTest extends TestCase
{
    public function testCreate(): void
    {
        $request = new LangRequest(
            queryParams: $queryParams = ['name' => 'John'],
            headers: $headers = [
                'X-Header-1' => ['value-11', 'value-12'],
                'X-Header-2' => ['value-2'],
            ],
            cookieParams: $cookieParams = ['Cookie' => 'Val'],
        );

        self::assertEquals($queryParams, $request->getQueryParams());

        self::assertTrue($request->hasHeader('X-Header-1'));
        self::assertFalse($request->hasHeader('X-Header-3'));
        self::assertEquals('value-11, value-12', $request->getHeaderLine('X-Header-1'));
        self::assertEquals('value-2', $request->getHeaderLine('X-Header-2'));

        self::assertEquals($cookieParams, $request->getCookieParams());
    }
}
