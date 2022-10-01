<?php

declare(strict_types=1);

namespace Test\DetectLang;

use DetectLang\LangRequest;
use PHPUnit\Framework\TestCase;

use function DetectLang\detectLang;

/**
 * @internal
 */
final class DetectLangTest extends TestCase
{
    public function testDefault(): void
    {
        $request = new LangRequest(
            queryParams: [],
            headers: [],
            cookieParams: [],
        );

        $lang = detectLang($request, 'en');

        self::assertEquals('en', $lang);
    }

    public function testQueryParam(): void
    {
        $request = new LangRequest(
            queryParams: ['lang' => 'de'],
            headers: ['Accept-Language' => ['ru-ru', 'ru;q=0.8', 'en;q=0.4']],
            cookieParams: ['lang' => 'pt'],
        );

        $lang = detectLang($request, 'en');

        self::assertEquals('de', $lang);
    }

    public function testCookie(): void
    {
        $request = new LangRequest(
            queryParams: [],
            headers: ['Accept-Language' => ['ru-ru', 'ru;q=0.8', 'en;q=0.4']],
            cookieParams: ['lang' => 'pt'],
        );

        $lang = detectLang($request, 'en');

        self::assertEquals('pt', $lang);
    }

    public function testHeader(): void
    {
        $request = new LangRequest(
            queryParams: [],
            headers: ['Accept-Language' => ['ru-ru', 'ru;q=0.8', 'en;q=0.4']],
            cookieParams: [],
        );

        $lang = detectLang($request, 'en');

        self::assertEquals('ru', $lang);
    }
}
