<?php

declare(strict_types=1);

namespace Test\App;

use PHPUnit\Framework\TestCase;

use function App\detectLang;

/**
 * @internal
 */
final class DetectLangTest extends TestCase
{
    public function testDefault(): void
    {
        $_GET = [];
        $_POST = [];
        $_COOKIE = [];
        $_SERVER = [];

        $lang = detectLang('en');

        self::assertEquals('en', $lang);
    }

    public function testQueryParam(): void
    {
        $_GET = ['lang' => 'de'];
        $_POST = ['lang' => 'fr'];
        $_COOKIE = ['lang' => 'pt'];
        $_SERVER = ['HTTP_ACCEPT_LANGUAGE' => 'ru-ru,ru;q=0.8,en;q=0.4'];

        $lang = detectLang('en');

        self::assertEquals('de', $lang);
    }

    public function testBodyParam(): void
    {
        $_GET = [];
        $_POST = ['lang' => 'fr'];
        $_COOKIE = ['lang' => 'pt'];
        $_SERVER = ['HTTP_ACCEPT_LANGUAGE' => 'ru-ru,ru;q=0.8,en;q=0.4'];

        $lang = detectLang('en');

        self::assertEquals('fr', $lang);
    }

    public function testCookie(): void
    {
        $_GET = [];
        $_POST = [];
        $_COOKIE = ['lang' => 'pt'];
        $_SERVER = ['HTTP_ACCEPT_LANGUAGE' => 'ru-ru,ru;q=0.8,en;q=0.4'];

        $lang = detectLang('en');

        self::assertEquals('pt', $lang);
    }

    public function testHeader(): void
    {
        $_GET = [];
        $_POST = [];
        $_COOKIE = [];
        $_SERVER = ['HTTP_ACCEPT_LANGUAGE' => 'ru-ru,ru;q=0.8,en-us;q=0.6,en;q=0.4'];

        $lang = detectLang('en');

        self::assertEquals('ru', $lang);
    }
}
