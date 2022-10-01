<?php

declare(strict_types=1);

namespace App;

function detectLang(string $default): string
{
    if (!empty($_GET['lang']) && is_string($_GET['lang'])) {
        return $_GET['lang'];
    }

    if (!empty($_POST['lang']) && is_string($_POST['lang'])) {
        return $_POST['lang'];
    }

    if (!empty($_COOKIE['lang'])) {
        return $_COOKIE['lang'];
    }

    if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }

    return $default;
}
