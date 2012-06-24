<?php 
/* SVN FILE: $Id$ */
/* Product Fixture generated on: 2010-04-20 11:22:00 : 1271726520*/

class ProductFixture extends CakeTestFixture {
	var $name = 'Product';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'stock' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'price' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'description' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'model' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'manufacturer' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
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
}
?>