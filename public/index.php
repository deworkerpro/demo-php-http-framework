<?php

declare(strict_types=1);

http_response_code(500);

/**
 * @param array<string, array|string> $query
 * @param array<string, array|string> $body
 * @param array<string, string> $cookie
 * @param array<string, string> $server
 */
function detectLang(array $query, array $body, array $cookie, array $server, string $default): string
{
    if (!empty($query['lang']) && is_string($query['lang'])) {
        return $query['lang'];
    }

    if (!empty($body['lang']) && is_string($body['lang'])) {
        return $body['lang'];
    }

    if (!empty($cookie['lang'])) {
        return $cookie['lang'];
    }

    if (!empty($server['HTTP_ACCEPT_LANGUAGE'])) {
        return substr($server['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }

    return $default;
}

$name = $_GET['name'] ?? 'Guest';

if (!is_string($name)) {
    http_response_code(400);
    exit;
}

$lang = detectLang($_GET, $_POST, $_COOKIE, $_SERVER, 'en');

http_response_code(200);
header('Content-Type: text/plain; charset=utf-8');
header('X-Frame-Options: DENY');
echo 'Hello, ' . $name . '! Your lang is ' . $lang;
