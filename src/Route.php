<?php

namespace Src;

class Route
{
	
	
	public function __construct(){
	
	  
	}
	
   
   public function dispatch($routes,$url) {
   
   	
    if (!preg_match("~^/entrega1/([^/]+)/(\d+)$~", $url, $matches) && !preg_match("~^/entrega1/(\d+)$~", $url, $matches) && !preg_match("~^/entrega1/([^/]+)$~", $url, $matches) ) {
         return "NOT FOUND";
    }
	    
 	if (preg_match('#^/([^/]+)$#', $url, $matches)) {
 		return $matches[1];
      
    } elseif (preg_match('#^/([^/]+)/([^/]+)/([^/]+)$#', $url, $matches)) {
    	return $matches[1];
    
    }
    
    return "NOT FOUND";
	}
	
}