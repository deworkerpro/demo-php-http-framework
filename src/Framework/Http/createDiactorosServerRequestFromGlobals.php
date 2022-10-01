<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Http\Message\DiactorosStreamFactory;
use Framework\Http\Message\DiactorosUriFactory;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Stream;
use Laminas\Diactoros\Uri;

/**
 * @param array<string, array|string>|null $query
 * @param array<string, array|string>|null $body
 * @param array<string, string>|null $server
 * @param resource|null $input
 */
function createDiactorosServerRequestFromGlobals(
    ?array $server = null,
    ?array $query = null,
    ?array $cookie = null,
    ?array $body = null,
    mixed $input = null
): ServerRequest {
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
