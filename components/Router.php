<?php

class Router {
	public $routes;
	public function __construct(){
	  $routesPath = ROOT.'/../config/routes.php';
	  $this->routes = include ($routesPath);
	  
	}
	public function getUri(){
	  $uri = trim($_SERVER['REQUEST_URI'],'/');
	  return $uri == '' ? 'home' : $uri;
   }
   public function redirectOnError($route)
   {
	   $page =  $route;
	   ob_start();
	   include ROOT.'/../templates/error.html.php';
	   $output = ob_get_clean();
	   include ROOT.'/../templates/output.php';
	   exit();
   }
	public function run(){
		$uri = $this->getUri();
		$page_found = false;
	    foreach($this->routes as $uriPattern => $path) {
	    	if(preg_match("/$uriPattern/", $uri)){
		  $segments = explode('/', $path);
		  $className = array_shift($segments);
		  $controllerName = $className.'Controller';
		  $controllerName = ucfirst($controllerName);
		  $methodName = 'action'.ucfirst(array_shift($segments));
		  
		  $controllerFile = ROOT.'/../controllers/'.$controllerName.'.php';
		  if(file_exists($controllerFile)){
		    require_once $controllerFile;
		  } else {
			 $this->redirectOnError($className);
		  }
		  $controllerObject = new $controllerName($className);
		  if(method_exists($controllerObject, $methodName )){
				  $controllerObject->$methodName();
				  $page_found = true;
				  break;
		  	} else {
				$this->redirectOnError($methodName);
			  	  break;
			  }	  
	      } 
	    }
	    if(!$page_found) $this->redirectOnError($uri);
	}
}
