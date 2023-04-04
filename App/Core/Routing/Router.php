<?php

namespace App\Core\Routing;

use App\Core\Request;
use App\Core\Routing\Route;
use Exception;

class Router 
{
    private $request ;
    private $routes ;
    private $current_route;
    const BASE_CONTROLLER  = '\App\Controllers\\' ;
    public function __construct()
    {
        $this->request = new Request();
        $this->routes =  Route::routes();
        $this->current_route = $this->findRoute($this->request) ?? null ;
        //var_dump($this->current_route);
        #RUN MIDDLEWARE HERE
        $this->run_route_middleware();


    }

 
    private function run_route_middleware()
    {
            if(is_null($this->current_route))
            {
                return;
            }
            $middleware = $this->current_route['middleware'] ;
            foreach($middleware as $middleware_class)
            {
                $middleware_obj = new  $middleware_class;
                $middleware_obj->handle();
            }
            
            
    }
    public function findRoute(Request $request)
    {
        
        foreach($this->routes as $route)
        {
            if(!in_array($request->method() , $route['methods']))
            {
               continue ;
            }
            if($this->regex_matched($route))
            {
                return $route;
            }
        }
        return null ;
    }
    public function regex_matched($route)
    {
        global $request;
        $pattern = "/^". str_replace(['/','{','}'],['\/','(?<','>[-%\w]+)'],$route['uri'])."$/";
        $result = preg_match($pattern,$this->request->uri(),$matches) ;
        if(!$result)
        {
          
            return false ;
        }
        foreach($matches as $key => $value)
        {
            if(!is_int($key)){
                
                $request->add_route_param($key , $value);
            }
        }
        return true ;

    }
    public function dispatch404()
    {
        header("HTTP/1.0 404 Not Found");
     
        
        view('errors.404');
        die();
    }

    public function run()
    {
        if (is_null($this->current_route))
            $this->dispatch404();

        $this->dispatch($this->current_route);
    }

    private function dispatch($route)
    {
        $action = $route['action'];

        if(is_null($action) || empty($action))
        {
            return ;
        }

        if(is_callable($action))
        {
            $action();
            //call_user_func($action);
        }

        if(is_string($action))
        {
            $action = explode('@',$action);
        }

        if(is_array($action))
        {
            $class_name = self::BASE_CONTROLLER . $action[0];
            $method =  $action[1];
            if(!class_exists($class_name))
            {
               throw new \Exception("Class $class_name Not Exists!");
            }
            $controller = new $class_name() ;

            if(!method_exists($controller,$method))
            {
               throw new \Exception("Method $method Not Exists IN CLASS $class_name!");
            }

            $controller->{$method}();



        }



    }
}