<?php

declare(strict_types=1);

namespace Framework\Http\Message;

use Laminas\Diactoros\ServerRequest;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DiactorosServerRequestFactory implements ServerRequestFactoryInterface
{
    /**
     * @param array<string, array|string>|null $query
     * @param array<string, array|string>|null $body
     * @param array<string, string>|null $server
     * @param resource|null $input
     */
    public static function fromGlobals(
        ?array $server = null,
        ?array $query = null,
        ?array $cookie = null,
        ?array $body = null,
        mixed $input = null
    ): ServerRequestInterface {
        $server ??= $_SERVER;

        $headers = [
            'Content-Type' => [$server['CONTENT_TYPE']],
            'Content-Length' => [$server['CONTENT_LENGTH']],
        ];

        foreach ($server as $serverName => $serverValue) {
            if (str_starts_with($serverName, 'HTTP_')) {
                $name = ucwords(strtolower(str_replace('_', '-', substr($serverName, 5))), '-');
                /** @var string[] $values */
                $values = preg_split('#\s*,\s*#', $serverValue);
                $headers[$name] = $values;
            }
        }

        return new ServerRequest(
            serverParams: $server,
            uri: (new DiactorosUriFactory())->createUri(
                (!empty($server['HTTPS']) ? 'https' : 'http') . '://' . $server['HTTP_HOST'] . $server['REQUEST_URI']
            ),
            method: $server['REQUEST_METHOD'],
            body: (new DiactorosStreamFactory())->createStreamFromResource($input ?: fopen('php://input', 'r')),
            headers: $headers,
            cookieParams: $cookie ?? $_COOKIE,
            queryParams: $query ?? $_GET,
            parsedBody: $body ?? ($_POST ?: null)
        );
    }

    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        return new ServerRequest(
            serverParams: $serverParams,
            uri: is_string($uri) ? (new DiactorosUriFactory())->createUri($uri) : $uri,
            method: $method,
            body: (new DiactorosStreamFactory())->createStream(),
            headers: [],
            cookieParams: [],
            queryParams: [],
            parsedBody: null
        );
    }
}
