<?php
namespace App\Core;

class Response
{
    public static function redirect(string $path): void
    {
        header("Location: $path");
        exit;
    }

    public static function json(array $data, int $code = 200): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}