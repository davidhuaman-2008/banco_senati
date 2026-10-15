<?php
namespace App\Core;

class Request
{
    public static function post(string $key, $default = null) { return $_POST[$key] ?? $default; }
    public static function get(string $key, $default = null) { return $_GET[$key] ?? $default; }
    public static function all(): array { return array_merge($_GET, $_POST); }
}