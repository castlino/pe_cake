<?php 
/* SVN FILE: $Id$ */
/* Group Test cases generated on: 2010-04-20 11:21:46 : 1271726506*/
App::import('Model', 'Group');

class GroupTestCase extends CakeTestCase {
	var $Group = null;
	var $fixtures = array('app.group');

	function startTest() {
		$this->Group =& ClassRegistry::init('Group');
	}

	function testGroupInstance() {
		$this->assertTrue(is_a($this->Group, 'Group'));
	}

	function testGroupFind() {
		$this->Group->recursive = -1;
		$results = $this->Group->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Group' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2010-04-20 11:21:46',
			'modified'  => '2010-04-20 11:21:46'
		));
		$this->assertEqual($results, $expected);
	}
}
?>