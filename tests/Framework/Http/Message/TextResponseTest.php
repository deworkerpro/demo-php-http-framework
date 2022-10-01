<?php

declare(strict_types=1);

namespace Test\Framework\Http\Message;

use Laminas\Diactoros\ResponseFactory;
use PHPUnit\Framework\TestCase;

use function Framework\Http\Message\textResponse;

/**
 * @internal
 */
final class TextResponseTest extends TestCase
{
    public function testDefault(): void
    {
        $origin = (new ResponseFactory())->createResponse();

        $response = textResponse($origin, $content = 'Content');

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('text/plain; charset=utf-8', $response->getHeaderLine('Content-Type'));
        self::assertEquals($content, (string)$response->getBody());
    }

    public function testCode(): void
    {
        $origin = (new ResponseFactory())->createResponse();

        $response = textResponse($origin, $content = 'Content with Code', 203);

        self::assertEquals(203, $response->getStatusCode());
        self::assertEquals('text/plain; charset=utf-8', $response->getHeaderLine('Content-Type'));
        self::assertEquals($content, (string)$response->getBody());
    }
}
