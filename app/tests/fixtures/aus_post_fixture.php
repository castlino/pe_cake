<?php 
/* SVN FILE: $Id$ */
/* AusPost Fixture generated on: 2010-04-23 17:29:09 : 1272007749*/

class AusPostFixture extends CakeTestFixture {
	var $name = 'AusPost';
	var $fields = array(
		'Pcode' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'Locality' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'State' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'Comments' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'DeliveryOffice' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'PresortIndicator' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'ParcelZone' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'BSPnumber' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'BSPname' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'Category' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'indexes' => array()
	);
	var $records = array(array(
		'Pcode'  => 1,
		'Locality'  => 'Lorem ipsum dolor sit amet',
		'State'  => 'Lorem ip',
		'Comments'  => 'Lorem ipsum dolor sit amet',
		'DeliveryOffice'  => 'Lorem ipsum dolor sit amet',
		'PresortIndicator'  => 1,
		'ParcelZone'  => 'Lorem ip',
		'BSPnumber'  => 1,
		'BSPname'  => 'Lorem ipsum dolor sit amet',
		'Category'  => 'Lorem ipsum dolor sit amet'
	));
}
?>