<?php

declare(strict_types=1);

namespace Test\App;

use Laminas\Diactoros\ServerRequestFactory;
use PHPUnit\Framework\TestCase;

use function App\detectLang;

/**
 * @internal
 */
final class DetectLangTest extends TestCase
{
    public function testDefault(): void
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/');

        $lang = detectLang($request, 'en');

        self::assertEquals('en', $lang);
    }

    public function testQueryParam(): void
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/')
            ->withQueryParams(['lang' => 'de'])
            ->withCookieParams(['lang' => 'pt'])
            ->withHeader('Accept-Language', ['ru-ru', 'ru;q=0.8', 'en;q=0.4']);

        $lang = detectLang($request, 'en');

        self::assertEquals('de', $lang);
    }

    public function testCookie(): void
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/')
            ->withCookieParams(['lang' => 'pt'])
            ->withHeader('Accept-Language', ['ru-ru', 'ru;q=0.8', 'en;q=0.4']);

        $lang = detectLang($request, 'en');

        self::assertEquals('pt', $lang);
    }

    public function testHeader(): void
    {
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/')
            ->withHeader('Accept-Language', ['ru-ru', 'ru;q=0.8', 'en;q=0.4']);

        $lang = detectLang($request, 'en');

        self::assertEquals('ru', $lang);
    }
}
