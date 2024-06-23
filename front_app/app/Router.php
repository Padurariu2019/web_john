<?php
require_once BASE_PATH . '/app/Middleware/Middleware.php';

class Router {
    private $routes = [];

    private function addRoute($url, $method, $handler) : void {
        $this->routes[] = [
            'url' => $url,
            'method' => $method,
            'handler' => $handler,
            'middleware' => []
        ];
    }

    private function abort($code) : void {
        http_response_code($code);
        die();
    }

    public function get($url, $handler) {
        $this->addRoute($url, 'GET', $handler);
        return $this;
    }

    public function post($url, $handler) {
        $this->addRoute($url, 'POST', $handler);
        return $this;
    }

    public function delete($url, $handler) {
        $this->addRoute($url, 'DELETE', $handler);
        return $this;
    }

    public function use(Middleware $middleware) {
        $this->routes[array_key_last($this->routes)]['middleware'][] = $middleware;
        return $this;
    }

    private function matches($route, $uri) : bool {
        $route_parts = explode('/', $route);
        $uri_parts = explode('/', $uri);
        if (count($route_parts) !== count($uri_parts)) {
            return false;
        }
        foreach ($route_parts as $key => $route_part) {
            // echo($uri_parts[$key]);
            if (strpos($route_part, '{') === false && $route_part !== $uri_parts[$key]) {
                return false;
            }
        }
        return true;
    }

    private function getQueryParams($uri) : array
    {
        $query_params = [];
        $url = parse_url($uri, PHP_URL_QUERY);
        if ($url === null) {
            return $query_params;
        }
        $query_parts = explode('&', $url);
        if (strlen($query_parts[0]) == 0) {
            unset($query_parts[0]);
        }
        if (!empty($query_parts)) {
            foreach ($query_parts as $query_part) {
                $query_param = explode('=', $query_part);
                $query_params[$query_param[0]] = $query_param[1];
            }
        }
        return $query_params;
    }

    /*
    * This function will return an array with two keys: path and query.
    * The path key will contain the path parameters, and the query key will contain the query parameters.
    */
    private function getPathParams($route_uri, $uri) : array {
        $path_params = [];
        $uri_parts = explode('/', parse_url($uri, PHP_URL_PATH));
        $route_parts = explode('/', $route_uri);
        foreach ($route_parts as $key => $route_part) {
            if (strpos($route_part, '{') !== false) {
                $param_name = str_replace(['{', '}'], '', $route_part);
                $path_params[$param_name] = $uri_parts[$key];
            }
        }

        return $path_params;
    }

    public function route($uri, $method) : void {
        foreach ($this->routes as $route) {
            if ($method === $route['method'] && $this->matches($route['url'], parse_url($uri, PHP_URL_PATH))) {
                foreach ($route['middleware'] as $middleware) {
                    $middleware->handle();
                }
                $path_params = $this->getPathParams($route['url'], $uri);
                $query_params = $this->getQueryParams($uri);
                $route['handler']($path_params, $query_params);
                return;
            }
        }

        $this->abort(404);
    }
}