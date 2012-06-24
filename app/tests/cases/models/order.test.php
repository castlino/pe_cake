<?php 
/* SVN FILE: $Id$ */
/* Order Test cases generated on: 2010-04-20 11:21:50 : 1271726510*/
App::import('Model', 'Order');

class OrderTestCase extends CakeTestCase {
	var $Order = null;
	var $fixtures = array('app.order');

	function startTest() {
		$this->Order =& ClassRegistry::init('Order');
	}

	function testOrderInstance() {
		$this->assertTrue(is_a($this->Order, 'Order'));
	}

	function testOrderFind() {
		$this->Order->recursive = -1;
		$results = $this->Order->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Order' => array(
			'id'  => 1,
			'customer_id'  => 1,
			'shipping_company_name'  => 'Lorem ipsum dolor sit amet',
			'shipping_unit_number'  => 'Lorem ipsum dolor sit amet',
			'shipping_street_address'  => 'Lorem ipsum dolor sit amet',
			'shipping_suburb'  => 'Lorem ipsum dolor sit amet',
			'shipping_postcode'  => 'Lorem ipsum dolor sit amet',
			'shipping_state'  => 'Lorem ipsum dolor sit amet',
			'shipping_country'  => 'Lorem ipsum dolor sit amet',
			'shipping_email'  => 'Lorem ipsum dolor sit amet',
			'shipping_method'  => 'Lorem ipsum dolor sit amet',
			'payment_method'  => 'Lorem ipsum dolor sit amet',
			'currency'  => 'Lorem ipsum dolor sit amet',
			'ip_address'  => 'Lorem ipsum dolor sit amet',
			'paypal_transid'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2010-04-20 11:21:50',
			'modified'  => '2010-04-20 11:21:50'
		));
		$this->assertEqual($results, $expected);
	}
}
?>