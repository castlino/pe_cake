<?php 
/* SVN FILE: $Id$ */
/* Order Fixture generated on: 2010-04-20 11:21:50 : 1271726510*/

class OrderFixture extends CakeTestFixture {
	var $name = 'Order';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'customer_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'shipping_company_name' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'shipping_unit_number' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'shipping_street_address' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'shipping_suburb' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'shipping_postcode' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'shipping_state' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'shipping_country' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'shipping_email' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'shipping_method' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'payment_method' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'currency' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'ip_address' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'paypal_transid' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
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
}
?>