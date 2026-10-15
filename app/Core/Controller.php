<?php
namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        require __DIR__ . '/../Views/layouts/app.php';
    }

    protected function redirect(string $path): void
    {
        header("Location: $path");
        exit;
    }

    protected function json(array $data, int $code = 200): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}