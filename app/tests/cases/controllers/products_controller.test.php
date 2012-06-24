<?php 
/* SVN FILE: $Id$ */
/* ProductsController Test cases generated on: 2010-04-20 11:22:00 : 1271726520*/
App::import('Controller', 'Products');

class TestProducts extends ProductsController {
	var $autoRender = false;
}

class ProductsControllerTest extends CakeTestCase {
	var $Products = null;

	function startTest() {
		$this->Products = new TestProducts();
		$this->Products->constructClasses();
	}

	function testProductsControllerInstance() {
		$this->assertTrue(is_a($this->Products, 'ProductsController'));
	}

	function endTest() {
		unset($this->Products);
	}
}
?>