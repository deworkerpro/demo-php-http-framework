<?php

declare(strict_types=1);

namespace Test\Framework\Http\Message;

use Framework\Http\Message\DiactorosResponseFactory;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class DiactorosResponseFactoryTest extends TestCase
{
    public function testDefault(): void
    {
        $factory = new DiactorosResponseFactory();

        $response = $factory->createResponse();

        self::assertEquals(200, $response->getStatusCode());
    }

    public function testCode(): void
    {
        $factory = new DiactorosResponseFactory();

        $response = $factory->createResponse(302);

        self::assertEquals(302, $response->getStatusCode());
    }
}
