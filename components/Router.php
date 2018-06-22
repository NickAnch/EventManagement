<?php

class Router {
    private $routes;// массив , в котором хранятся маршруты

    public function __construct(){
        $routesPath= ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    //Returns request string
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run(){ //принимает управление от front контроллера
        //Получаем строку запроса
        $uri = $this->getURI();

        //Проверяем наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path){
            if (preg_match("~$uriPattern~", $uri)){
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute); //разбивает строку на массив

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = ROOT .'/controllers/' .$controllerName .'.php';
                if (file_exists($controllerFile)){
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result =  call_user_func_array(array($controllerObject,$actionName),$parameters);
                if ($result != null){
                    break;
                }
            }
        }
    }
}
?>
