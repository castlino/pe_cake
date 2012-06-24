<?php 
/* SVN FILE: $Id$ */
/* OrdersProduct Test cases generated on: 2010-04-20 11:21:57 : 1271726517*/
App::import('Model', 'OrdersProduct');

class OrdersProductTestCase extends CakeTestCase {
	var $OrdersProduct = null;
	var $fixtures = array('app.orders_product');

	function startTest() {
		$this->OrdersProduct =& ClassRegistry::init('OrdersProduct');
	}

	function testOrdersProductInstance() {
		$this->assertTrue(is_a($this->OrdersProduct, 'OrdersProduct'));
	}

	function testOrdersProductFind() {
		$this->OrdersProduct->recursive = -1;
		$results = $this->OrdersProduct->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('OrdersProduct' => array(
			'id'  => 1,
			'order_id'  => 1,
			'product_id'  => 1,
			'created'  => '2010-04-20 11:21:57',
			'modified'  => '2010-04-20 11:21:57'
		));
		$this->assertEqual($results, $expected);
	}
}
?>