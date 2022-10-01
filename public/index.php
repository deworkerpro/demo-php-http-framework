<?php

declare(strict_types=1);

$name = $_GET['name'] ?? 'Guest';

if (!is_string($name)) {
    exit;
}

header('Content-Type: text/plain; charset=utf-8');

echo 'Hello, ' . $name . '!';
