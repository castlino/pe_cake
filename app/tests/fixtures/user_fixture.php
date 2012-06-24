<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2010-04-20 11:22:02 : 1271726522*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'username' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'password' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'group_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'username' => array('column' => 'username', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'username'  => 'Lorem ipsum dolor sit amet',
		'password'  => 'Lorem ipsum dolor sit amet',
		'group_id'  => 1,
		'created'  => '2010-04-20 11:22:02',
		'modified'  => '2010-04-20 11:22:02'
	));
}
?>