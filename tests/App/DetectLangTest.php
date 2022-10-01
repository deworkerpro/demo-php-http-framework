<?php

declare(strict_types=1);

namespace Test\App;

use Framework\Http\Message\ServerRequest;
use Framework\Http\Message\Stream;
use Framework\Http\Message\Uri;
use PHPUnit\Framework\TestCase;

use function App\detectLang;

/**
 * @internal
 */
final class DetectLangTest extends TestCase
{
    public function testDefault(): void
    {
        $request = new ServerRequest(
            serverParams: [],
            uri: new Uri('/'),
            method: 'GET',
            queryParams: [],
            headers: [],
            cookieParams: [],
            body: new Stream(fopen('php://memory', 'r')),
            parsedBody: null
        );

        $lang = detectLang($request, 'en');

        self::assertEquals('en', $lang);
    }

    public function testQueryParam(): void
    {
        $request = new ServerRequest(
            serverParams: [],
            uri: new Uri('/'),
            method: 'GET',
            queryParams: ['lang' => 'de'],
            headers: ['Accept-Language' => 'ru-ru,ru;q=0.8,en;q=0.4'],
            cookieParams: ['lang' => 'pt'],
            body: new Stream(fopen('php://memory', 'r')),
            parsedBody: null
        );

        $lang = detectLang($request, 'en');

        self::assertEquals('de', $lang);
    }

    public function testCookie(): void
    {
        $request = new ServerRequest(
            serverParams: [],
            uri: new Uri('/'),
            method: 'GET',
            queryParams: [],
            headers: ['Accept-Language' => 'ru-ru,ru;q=0.8,en;q=0.4'],
            cookieParams: ['lang' => 'pt'],
            body: new Stream(fopen('php://memory', 'r')),
            parsedBody: null
        );

        $lang = detectLang($request, 'en');

        self::assertEquals('pt', $lang);
    }

    public function testHeader(): void
    {
        $request = new ServerRequest(
            serverParams: [],
            uri: new Uri('/'),
            method: 'GET',
            queryParams: [],
            headers: ['Accept-Language' => 'ru-ru,ru;q=0.8,en;q=0.4'],
            cookieParams: [],
            body: new Stream(fopen('php://memory', 'r')),
            parsedBody: null
        );

        $lang = detectLang($request, 'en');

        self::assertEquals('ru', $lang);
    }
}
