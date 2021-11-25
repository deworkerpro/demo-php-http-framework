<?php

declare(strict_types=1);

namespace Test\App;

use App\Example;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ExampleTest extends TestCase
{
    public function testSuccess(): void
    {
        $example = new Example();

        $result = $example->do();

        self::assertEquals(42, $result);
    }
}
