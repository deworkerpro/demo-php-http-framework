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
        $lang = detectLang('en');

        self::assertEquals('en', $lang);
    }
}
