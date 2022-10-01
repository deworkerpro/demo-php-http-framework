<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Http\Message\ServerRequest;
use Framework\Http\Message\Stream;
use Framework\Http\Message\Uri;

/**
 * @param array<string, array|string>|null $query
 * @param array<string, array|string>|null $body
 * @param array<string, string>|null $server
 * @param resource|null $input
 */
function createServerRequestFromGlobals(
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
        uri: new Uri(
            (!empty($server['HTTPS']) ? 'https' : 'http') . '://' . $server['HTTP_HOST'] . $server['REQUEST_URI']
        ),
        method: $server['REQUEST_METHOD'],
        queryParams: $query ?? $_GET,
        headers: $headers,
        cookieParams: $cookie ?? $_COOKIE,
        body: new Stream($input ?: fopen('php://input', 'r')),
        parsedBody: $body ?? ($_POST ?: null)
    );
}
