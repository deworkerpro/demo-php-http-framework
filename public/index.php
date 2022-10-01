<?php

declare(strict_types=1);

$name = $_GET['name'] ?? 'Guest';

if (!is_string($name)) {
    exit;
}

echo '<h1>Hello, ' . htmlspecialchars($name) . '!</h1>';
