<?php 
/* SVN FILE: $Id$ */
/* Product Test cases generated on: 2010-04-20 11:22:00 : 1271726520*/
App::import('Model', 'Product');

class ProductTestCase extends CakeTestCase {
	var $Product = null;
	var $fixtures = array('app.product');

	function startTest() {
		$this->Product =& ClassRegistry::init('Product');
	}

	function testProductInstance() {
		$this->assertTrue(is_a($this->Product, 'Product'));
	}

	function testProductFind() {
		$this->Product->recursive = -1;
		$results = $this->Product->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Product' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'stock'  => 1,
			'price'  => 1,
			'description'  => 'Lorem ipsum dolor sit amet',
			'model'  => 'Lorem ipsum dolor sit amet',
			'manufacturer'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2010-04-20 11:22:00',
			'modified'  => '2010-04-20 11:22:00'
		));
		$this->assertEqual($results, $expected);
	}
}
?>