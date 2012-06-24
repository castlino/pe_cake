<?php 
/* SVN FILE: $Id$ */
/* OrdersProductsController Test cases generated on: 2010-04-20 11:21:57 : 1271726517*/
App::import('Controller', 'OrdersProducts');

class TestOrdersProducts extends OrdersProductsController {
	var $autoRender = false;
}

class OrdersProductsControllerTest extends CakeTestCase {
	var $OrdersProducts = null;

	function startTest() {
		$this->OrdersProducts = new TestOrdersProducts();
		$this->OrdersProducts->constructClasses();
	}

	function testOrdersProductsControllerInstance() {
		$this->assertTrue(is_a($this->OrdersProducts, 'OrdersProductsController'));
	}

	function endTest() {
		unset($this->OrdersProducts);
	}
}
?>