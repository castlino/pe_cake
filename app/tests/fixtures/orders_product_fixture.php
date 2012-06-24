<?php 
/* SVN FILE: $Id$ */
/* OrdersProduct Fixture generated on: 2010-04-20 11:21:57 : 1271726517*/

class OrdersProductFixture extends CakeTestFixture {
	var $name = 'OrdersProduct';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'order_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'product_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'order_id'  => 1,
		'product_id'  => 1,
		'created'  => '2010-04-20 11:21:57',
		'modified'  => '2010-04-20 11:21:57'
	));
}
?>