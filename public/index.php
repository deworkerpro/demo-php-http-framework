<?php

declare(strict_types=1);

/** @var string $name */
$name = $_GET['name'] ?? 'Guest';

echo '<h1>Hello, ' . htmlspecialchars($name) . '!</h1>';
