<?php

namespace Src;

class Route{
	private $url;
	
	public function __construct($url){
		$this->url = $url;
	}	
	
	public function get(){
		return $this->url;	
	}
	
	public function set($url){
		$this->url = $url;	
	}
}

?>