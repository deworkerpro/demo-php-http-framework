<?php

declare(strict_types=1);

namespace Test\Framework\Http\Message;

use Framework\Http\Message\Uri;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class UriTest extends TestCase
{
    public function testCreate(): void
    {
        $uri = new Uri($string = 'https://user:pass@test:81/home?a=2&b=3#first');

        self::assertEquals('https', $uri->getScheme());
        self::assertEquals('user:pass', $uri->getUserInfo());
        self::assertEquals('test', $uri->getHost());
        self::assertEquals(81, $uri->getPort());
        self::assertEquals('/home', $uri->getPath());
        self::assertEquals('a=2&b=3', $uri->getQuery());
        self::assertEquals('first', $uri->getFragment());

        self::assertEquals($string, (string)$uri);
    }
}
