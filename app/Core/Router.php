<?php
namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, array $action): void  { $this->add('GET', $uri, $action); }
    public function post(string $uri, array $action): void { $this->add('POST', $uri, $action); }

    private function add(string $method, string $uri, array $action): void
    {
        $uri = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $uri);
        $this->routes[] = compact('method', 'uri', 'action');
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match("#^{$route['uri']}$#", $uri, $m)) {
                [$class, $fn] = $route['action'];
                $params = array_filter($m, 'is_string', ARRAY_FILTER_USE_KEY);
                (new $class)->$fn(...array_values($params));
                return;
            }
        }
        http_response_code(404);
        require __DIR__ . '/../Views/errors/404.php';
    }
}