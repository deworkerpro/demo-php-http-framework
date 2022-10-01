<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Http\Message\ServerRequest;

/**
 * @param array<string, array|string>|null $query
 * @param array<string, array|string>|null $body
 * @param array<string, string>|null $server
 */
function createServerRequestFromGlobals(
    ?array $server = null,
    ?array $query = null,
    ?array $cookie = null,
    ?array $body = null,
    ?string $input = null
): ServerRequest {
    $server ??= $_SERVER;

    $headers = [
        'Content-Type' => $server['CONTENT_TYPE'],
        'Content-Length' => $server['CONTENT_LENGTH'],
    ];

    foreach ($server as $serverName => $serverValue) {
        if (str_starts_with($serverName, 'HTTP_')) {
            $name = ucwords(strtolower(str_replace('_', '-', substr($serverName, 5))), '-');
            $headers[$name] = $serverValue;
        }
    }

    return new ServerRequest(
        serverParams: $server,
        uri: $server['REQUEST_URI'],
        method: $server['REQUEST_METHOD'],
        queryParams: $query ?? $_GET,
        headers: $headers,
        cookieParams: $cookie ?? $_COOKIE,
        body: $input ?? file_get_contents('php://input'),
        parsedBody: $body ?? ($_POST ?: null)
    );
}
