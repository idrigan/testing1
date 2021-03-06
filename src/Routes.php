<?php

namespace Src;

class Routes
{
	
	private $routes; 
	
   public function __construct() {
   
		$this->routes = array();   
   }
   
	public function setRoutes($routes = array()){
		$this->routes = $routes;	
	}   
   
   public function addRoute(Route $route){
		$this->routes[] = $route;   
   }
   
   public function getRoutes(){
		return $this->routes;   
   }

	public function dispatch($url,$regex) {
		$parameters = [];
        preg_match_all('\'' . '{(\w+)}' . '\'', $regex, $matches);
        $matches = $matches[0];
        foreach ($matches as $key => $value) {
            $matches[$key] = str_replace('{', '', $matches[$key]);
            $matches[$key] = str_replace('}', '', $matches[$key]);
        }
       
        $regex = preg_replace('%' . '{(\w+)}' . '%', '(\w+|\d+)', $regex);
        $regex .= '$';
        $regex = '%^' . $regex . '$%';
        $res = preg_match($regex, $url, $parameters);
    
        if (!$res || $res == 0) return false;
        
        $params = array();
        foreach($matches as $index=>$value){
        	$params[$value] = $parameters[$index+1];
        }
/*        for ($i = 0; $i < count($matches); $i++) {
            $keyParams[$matches[$i]] = $parameters[$i + 1];
        }
*/    
        return $params;
    }
}