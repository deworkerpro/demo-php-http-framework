<?php

declare(strict_types=1);

http_response_code(500);

$name = $_GET['name'] ?? 'Guest';

if (!is_string($name)) {
    http_response_code(400);
    exit;
}

http_response_code(200);
header('Content-Type: text/plain; charset=utf-8');
header('X-Frame-Options: DENY');
echo 'Hello, ' . $name . '!';
