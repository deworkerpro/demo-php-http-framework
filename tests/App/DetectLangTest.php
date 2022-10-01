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

        $lang = detectLang('en');

        self::assertEquals('en', $lang);
    }

    public function testQueryParam(): void
    {
        $_GET = ['lang' => 'de'];
        $_POST = ['lang' => 'fr'];

        $lang = detectLang('en');

        self::assertEquals('de', $lang);
    }

    public function testBodyParam(): void
    {
        $_GET = [];
        $_POST = ['lang' => 'fr'];

        $lang = detectLang('en');

        self::assertEquals('fr', $lang);
    }
}
