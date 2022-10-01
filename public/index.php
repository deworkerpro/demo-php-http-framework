<?php

declare(strict_types=1);

$name = $_GET['name'] ?? 'Guest';

if (!is_string($name)) {
    exit;
}

header('Content-Type: text/plain; charset=utf-8');
header('X-Frame-Options: DENY');

echo 'Hello, ' . $name . '!';
