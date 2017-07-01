<?php

namespace Test;

require './vendor/autoload.php';

use Src\Routes;
use Src\Route;


class RouteTest extends \PHPUnit_Framework_TestCase {
	
	private $routes;	
	
	private $route;
	
	private $route1;
	private $route2;
	private $route3;
	private $route4;	
	private $route5;	
	
	const EMPTYELEMENTS = 0;
   
   protected function setUp()
   {
        $this->route = new Routes();
        $this->routes = array(
   		0=>'/entrega1/',
   		1=>'/entrega1/post/{id}',
			2=>'/entrega1/order/{id}',
			3=>'/entrega1/pruduct/{name}',
			4=>'/entrega1/pruduct/{name}/{type}'
   	  );
    }
   
    protected function tearDown()
    {
        $this->route = null;
 		  $this->routes = array();
    }
    
   /**
    @test
    */
   public function shouldNoneElementsRoutes(){
		$this->assertEquals(self::EMPTYELEMENTS,count($this->route->getRoutes()));   
   }     
  
  /**
    @test
  */
	public function shouldAddRoute() {  
	
    	$this->route1 = new Route("/entrega1/");
		$this->route2 = new Route("/entrega1/post/6");
		$this->route3 = new Route("/entrega1/order/1");
		$this->route4 = new Route("/entrega1/pruduct/prueba");
	
		
		$this->route->addRoute($this->route1);
		$this->route->addRoute($this->route2);
		$this->route->addRoute($this->route3);
		$this->route->addRoute($this->route4);

   	$this->assertEquals($this->route1->get(),$this->route->getRoutes()[0]->get());
		$this->assertEquals($this->route2->get(),$this->route->getRoutes()[1]->get());
		$this->assertEquals($this->route3->get(),$this->route->getRoutes()[2]->get());
		$this->assertEquals($this->route4->get(),$this->route->getRoutes()[3]->get()); 
   }
   
   
	public function shouldReturnNotFound() {
		$this->assertFalse($this->routes->dispatch($this->route1->get(),$this->routes[3]),"La ruta coincide");
   }
	/**
		@test
	*/    
   public function shouldReturnParam(){
   	$this->route3 = new Route("/entrega1/pruduct/prueba");
   	$this->assertEquals("prueba",$this->route->dispatch($this->route3->get(),$this->routes[3])['name']);
   }
   /**
		@test
	*/  
 	public function shouldReturnNotEqualsParam(){
   	$this->route3 = new Route("/entrega1/pruduct/prueba");
   	$this->assertNotEquals($this->route->dispatch($this->route3->get(),$this->routes[3])['name'],"nofound");
   }
   
   /** @test */
   public function shouldReturnParamsVariab()
   {
   		$this->route5 = new Route("/entrega1/pruduct/prueba/categoria1");
       $this->assertEquals( $this->route->dispatch($this->route5->get(),$this->routes[4]),["name" =>"prueba","type"=>"categoria1"]);
   }

 

}