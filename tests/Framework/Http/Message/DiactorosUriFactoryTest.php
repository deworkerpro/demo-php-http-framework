<?php

declare(strict_types=1);

namespace Test\Framework\Http\Message;

use Framework\Http\Message\DiactorosUriFactory;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class DiactorosUriFactoryTest extends TestCase
{
    public function testDefault(): void
    {
        $factory = new DiactorosUriFactory();

        $uri = $factory->createUri($string = 'https://user:pass@test:81/home?a=2&b=3#first');

        self::assertEquals($string, (string)$uri);
    }
}
