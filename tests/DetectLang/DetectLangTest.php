<?php

declare(strict_types=1);

namespace Test\DetectLang;

use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;

use function DetectLang\detectLang;

/**
 * @internal
 */
final class DetectLangTest extends TestCase
{
    public function testDefault(): void
    {
        $request = new ServerRequest();

        $lang = detectLang($request, 'en');

        self::assertEquals('en', $lang);
    }

    public function testQueryParam(): void
    {
        $request = (new ServerRequest())
            ->withQueryParams(['lang' => 'de'])
            ->withCookieParams(['lang' => 'pt'])
            ->withHeader('Accept-Language', ['ru-ru', 'ru;q=0.8', 'en;q=0.4']);

        $lang = detectLang($request, 'en');

        self::assertEquals('de', $lang);
    }

    public function testCookie(): void
    {
        $request = (new ServerRequest())
            ->withCookieParams(['lang' => 'pt'])
            ->withHeader('Accept-Language', ['ru-ru', 'ru;q=0.8', 'en;q=0.4']);

        $lang = detectLang($request, 'en');

        self::assertEquals('pt', $lang);
    }

    public function testHeader(): void
    {
        $request = (new ServerRequest())
            ->withHeader('Accept-Language', ['ru-ru', 'ru;q=0.8', 'en;q=0.4']);

        $lang = detectLang($request, 'en');

        self::assertEquals('ru', $lang);
    }
}
