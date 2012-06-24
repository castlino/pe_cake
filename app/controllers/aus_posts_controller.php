<?php
class AusPostsController extends AppController {

	var $name = 'AusPosts';
	var $helpers = array('Html', 'Form');

	function beforeFilter() {
		parent::beforeFilter(); 
    	$this->Auth->allow('*');
	}
	
	function index() {
		$this->AusPost->recursive = 0;
		$this->set('ausPosts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid AusPost.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ausPost', $this->AusPost->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AusPost->create();
			if ($this->AusPost->save($this->data)) {
				$this->Session->setFlash(__('The AusPost has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The AusPost could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid AusPost', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->AusPost->save($this->data)) {
				$this->Session->setFlash(__('The AusPost has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The AusPost could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AusPost->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for AusPost', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AusPost->del($id)) {
			$this->Session->setFlash(__('AusPost deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>