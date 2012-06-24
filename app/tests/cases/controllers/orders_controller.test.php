<?php 
/* SVN FILE: $Id$ */
/* OrdersController Test cases generated on: 2010-04-20 11:21:50 : 1271726510*/
App::import('Controller', 'Orders');

class TestOrders extends OrdersController {
	var $autoRender = false;
}

class OrdersControllerTest extends CakeTestCase {
	var $Orders = null;

	function startTest() {
		$this->Orders = new TestOrders();
		$this->Orders->constructClasses();
	}

	function testOrdersControllerInstance() {
		$this->assertTrue(is_a($this->Orders, 'OrdersController'));
	}

	function endTest() {
		unset($this->Orders);
	}
}
?>