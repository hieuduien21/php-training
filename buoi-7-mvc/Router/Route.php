<?php
namespace Router;

class Route
{
    private $routes = [];

    public function addRoute($path, $routeInfo)
    {
        $this->routes[$path] = $routeInfo;

    }

    public function dispatchRoute($pathCurrent)
    { 
        $pathCurrent = explode('?', $pathCurrent)[0]; 

        // foreach ($this->routes as $key => $itemRoute) {
        //     if ($key === $pathCurrent) {
        //         $controller = $itemRoute['controller']; 
        //         $action = $itemRoute['action'];

        //         $instanceController = new $controller();
        //         $instanceController->$action();
        //     }
        // }

        if (!empty($this->routes[$pathCurrent])) {
            $pathInfo = $this->routes[$pathCurrent];

            $controller = $pathInfo['controller']; 
            $action = $pathInfo['action'];

            $instanceController = new $controller();
            $instanceController->$action();
        } else {
            echo 'url is not exist';
            return;
        }
    }
}
