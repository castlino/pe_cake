<?php 
/* SVN FILE: $Id$ */
/* AusPostsController Test cases generated on: 2010-04-23 17:29:09 : 1272007749*/
App::import('Controller', 'AusPosts');

class TestAusPosts extends AusPostsController {
	var $autoRender = false;
}

class AusPostsControllerTest extends CakeTestCase {
	var $AusPosts = null;

	function startTest() {
		$this->AusPosts = new TestAusPosts();
		$this->AusPosts->constructClasses();
	}

	function testAusPostsControllerInstance() {
		$this->assertTrue(is_a($this->AusPosts, 'AusPostsController'));
	}

	function endTest() {
		unset($this->AusPosts);
	}
}
?>