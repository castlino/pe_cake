<?php 
/* SVN FILE: $Id$ */
/* Customer Test cases generated on: 2010-04-20 11:21:44 : 1271726504*/
App::import('Model', 'Customer');

class CustomerTestCase extends CakeTestCase {
	var $Customer = null;
	var $fixtures = array('app.customer');

	function startTest() {
		$this->Customer =& ClassRegistry::init('Customer');
	}

	function testCustomerInstance() {
		$this->assertTrue(is_a($this->Customer, 'Customer'));
	}

	function testCustomerFind() {
		$this->Customer->recursive = -1;
		$results = $this->Customer->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Customer' => array(
			'id'  => 1,
			'last_name'  => 'Lorem ipsum dolor sit amet',
			'first_name'  => 'Lorem ipsum dolor sit amet',
			'company_name'  => 'Lorem ipsum dolor sit amet',
			'unit_number'  => 'Lorem ipsum dolor sit amet',
			'street_address'  => 'Lorem ipsum dolor sit amet',
			'suburb'  => 'Lorem ipsum dolor sit amet',
			'postcode'  => 'Lorem ipsum dolor sit amet',
			'state'  => 'Lorem ipsum dolor sit amet',
			'country'  => 'Lorem ipsum dolor sit amet',
			'email'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2010-04-20 11:21:44',
			'modified'  => '2010-04-20 11:21:44'
		));
		$this->assertEqual($results, $expected);
	}
}
?>