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
