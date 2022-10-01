<?php

declare(strict_types=1);

http_response_code(500);

/**
 * @param array{
 *     queryParams: array<string, string|array>,
 *     parsedBody: array<string, string|array>|null,
 *     headers: array<string, string>,
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

    if (!empty($request['headers']['Accept-Language'])) {
        return substr($request['headers']['Accept-Language'], 0, 2);
    }

    return $default;
}

$request = [
    'serverParams' => $_SERVER,
    'uri' => $_SERVER['REQUEST_URI'],
    'method' => $_SERVER['REQUEST_METHOD'],
    'queryParams' => $_GET,
    'headers' => [
        'Accept-Language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
    ],
    'cookieParams' => $_COOKIE,
    'body' => file_get_contents('php://input'),
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
