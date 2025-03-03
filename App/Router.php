<?php

namespace App;

class Router
{
    public static array $routes = [];

    public static function get(string $path, array $params)
    {
        self::$routes[] = [
            'path' => self::formatPath($path),
            'params' => $params,
            'method' => 'GET'
        ];
    }

    public static function post(string $path, array $params)
    {
        self::$routes[] = [
            'path' => self::formatPath($path),
            'params' => $params,
            'method' => 'POST'
        ];
    }
    public static function delete(string $path, array $params)
    {
        self::$routes[] = [
            'path' => self::formatPath($path),
            'params' => $params,
            'method' => 'DELETE'
        ];
    }

    private static function formatPath(string $path): string
    {
      
        return preg_replace('/\{(\w+)\}/', '(\d+)', str_replace('/', '\/', $path));
    }

    public static function match(string $path, string $method): array|bool
    {
        foreach (self::$routes as $route) {
            if ($route['method'] === $method && preg_match('/^' . $route['path'] . '$/', $path, $matches)) {
                array_shift($matches); 
                return [
                    'params' => $route['params'],
                    'matches' => $matches
                ];
            }
        }
        return false;
    }

    public static function dispatch()
    {
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    
        // Xóa dấu "/" ở cuối nếu có, nhưng giữ lại nếu nó là trang chủ "/"
        if ($uri !== '/' && substr($uri, -1) === '/') {
            $uri = rtrim($uri, '/');
        }
        
    
        $method = $_SERVER['REQUEST_METHOD'];
        $matchedRoute = self::match($uri, $method);
    
        if ($matchedRoute) {
            $controllerName = 'App\\Controllers\\' . $matchedRoute['params']['controller'];
            $methodName = $matchedRoute['params']['action'];
            $controllerInstance = new $controllerName();
            call_user_func_array([$controllerInstance, $methodName], $matchedRoute['matches']);
        } else {
            header('location: /notfound');
        }
    }
    
}
