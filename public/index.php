<?php

declare(strict_types=1);

http_response_code(500);

/**
 * @param array{
 *     queryParams: array<string, string|array>,
 *     parsedBody: array<string, string|array>|null,
 *     cookieParams: array<string, string>,
 *     serverParams: array<string, string>
 * } $request
 */
function detectLang(array $request, string $default): string
{
    if (!empty($request['queryParams']['lang']) && is_string($request['queryParams']['lang'])) {
        return $request['queryParams']['lang'];
    }

    if (!empty($request['parsedBody']['lang']) && is_string($request['parsedBody']['lang'])) {
        return $request['parsedBody']['lang'];
    }

    if (!empty($request['cookieParams']['lang'])) {
        return $request['cookieParams']['lang'];
    }

    if (!empty($request['serverParams']['HTTP_ACCEPT_LANGUAGE'])) {
        return substr($request['serverParams']['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }

    return $default;
}

$request = [
    'serverParams' => $_SERVER,
    'queryParams' => $_GET,
    'cookieParams' => $_COOKIE,
    'parsedBody' => $_POST ?: null,
];

$name = $request['queryParams']['name'] ?? 'Guest';

if (!is_string($name)) {
    http_response_code(400);
    exit;
}

$lang = detectLang($request, 'en');

http_response_code(200);
header('Content-Type: text/plain; charset=utf-8');
header('X-Frame-Options: DENY');
echo 'Hello, ' . $name . '! Your lang is ' . $lang;
