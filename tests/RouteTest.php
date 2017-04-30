<?php

namespace Test;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Src\Route;
use PHPUnit_Framework_TestCase;

final class RouteTest extends PHPUnit_Framework_TestCase{
	
	private $routes;	
	
	/**
     * @var RouteClass
     */
    private $route;
    /**
     * @See https://phpunit.de/manual/current/en/fixtures.html
     */
    protected function setUp()
    {
        $this->route = new Route();
        $this->routes = array(
   		'/entrega1/'=> 'home_controller',
   		'/entrega1/post/{id}' => 'update_controller',
			'/entrega1/get/nombre/{id}'=>'get_controller',
			'/entrega1/pruducto/{id}'=>'producto_controller'
   	);
    }
    /**
     * @See https://phpunit.de/manual/current/en/fixtures.html
     */
    protected function tearDown()
    {
        $this->route = null;
    }
    /** @test */
    public function shouldReturnController()
    {
        self::assertEquals($this->route->dispatch($this->routes,"/entrega1/post/1"), "entrega1");
        self::assertEquals($this->route->dispatch($this->routes,"/entrega1/post/publicacion1/1"), "entrega1");
		  
    }
   
   
   
	 /** @test */
    public function shouldReturnNotFound()
    {
        self::assertEquals($this->route->dispatch($this->routes,"/entrega2/post/1"), "NOT FOUND");
    }

}