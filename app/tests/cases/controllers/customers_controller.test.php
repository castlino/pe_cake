<?php 
/* SVN FILE: $Id$ */
/* CustomersController Test cases generated on: 2010-04-20 11:21:44 : 1271726504*/
App::import('Controller', 'Customers');

class TestCustomers extends CustomersController {
	var $autoRender = false;
}

class CustomersControllerTest extends CakeTestCase {
	var $Customers = null;

	function startTest() {
		$this->Customers = new TestCustomers();
		$this->Customers->constructClasses();
	}

	function testCustomersControllerInstance() {
		$this->assertTrue(is_a($this->Customers, 'CustomersController'));
	}

	function endTest() {
		unset($this->Customers);
	}
}
?>