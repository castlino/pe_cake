<?php 
/* SVN FILE: $Id$ */
/* Customer Fixture generated on: 2010-04-20 11:21:44 : 1271726504*/

class CustomerFixture extends CakeTestFixture {
	var $name = 'Customer';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'last_name' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'first_name' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'company_name' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'unit_number' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'street_address' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'suburb' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'postcode' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'state' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'country' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'email' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
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
}
?>