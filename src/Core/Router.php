<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }

    public function put($path, $callback) {
        $this->addRoute('PUT', $path, $callback);
    }

    public function delete($path, $callback) {
        $this->addRoute('DELETE', $path, $callback);
    }

    private function addRoute($method, $path, $callback) {
        // Convertir les segments {param} en expression régulière
        $pattern = "@^" . preg_replace('/\{[a-zA-Z0-9_-]+\}/', '([^/]+)', $path) . "$@D";
        $this->routes[$method][$pattern] = $callback;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $callback) {
                if (preg_match($pattern, $uri, $matches)) {
                    // Retirer le premier élément correspondant à l'URL complète
                    array_shift($matches);

                    if (is_array($callback)) {
                        $controllerName = $callback[0];
                        $actionName = $callback[1];
                        
                        $controller = new $controllerName();
                        return call_user_func_array([$controller, $actionName], $matches);
                    }
                }
            }
        }

        // Si aucune route ne correspond
        http_response_code(404);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            "status" => "error",
            "message" => "API Endpoint non trouvé",
            "uri_recue" => $uri
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}