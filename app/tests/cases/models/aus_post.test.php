<?php 
/* SVN FILE: $Id$ */
/* AusPost Test cases generated on: 2010-04-23 17:29:09 : 1272007749*/
App::import('Model', 'AusPost');

class AusPostTestCase extends CakeTestCase {
	var $AusPost = null;
	var $fixtures = array('app.aus_post');

	function startTest() {
		$this->AusPost =& ClassRegistry::init('AusPost');
	}

	function testAusPostInstance() {
		$this->assertTrue(is_a($this->AusPost, 'AusPost'));
	}

	function testAusPostFind() {
		$this->AusPost->recursive = -1;
		$results = $this->AusPost->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('AusPost' => array(
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
		$this->assertEqual($results, $expected);
	}
}
?>