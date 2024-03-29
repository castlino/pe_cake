<?php 
/* SVN FILE: $Id$ */
/* Group Fixture generated on: 2010-04-20 11:21:46 : 1271726506*/

class GroupFixture extends CakeTestFixture {
	var $name = 'Group';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'name'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2010-04-20 11:21:46',
		'modified'  => '2010-04-20 11:21:46'
	));
}
?>