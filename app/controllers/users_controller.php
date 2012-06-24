<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');

	function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('login', 'logout');
            //$this->Auth->allow('*');
	}
	
	function login() {
    	//Auth Magic
            $this->layout = 'loginEmpty';
            if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash('You are logged in! server: '.$_SERVER['SERVER_NAME']);
			$this->redirect('/', null, false);
		}
	}
 
	function logout() {
    	//Leave empty for now.
    	$this->Session->setFlash('Good-Bye '.ucfirst($this->Auth->user('username')).'...');
		$this->redirect($this->Auth->logout());
		
	}
	
	
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function initDB() {
	    $group =& $this->User->Group;
	    
	    //Allow admins to everything
	    $group->id = 1;     
	    $this->Acl->allow($group, 'controllers');
	 
	    //all managers.
	    $group->id = 2;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Users/view');
	    $this->Acl->allow($group, 'controllers/Orders/validationView');
	    $this->Acl->allow($group, 'controllers/Orders/shippingView');
	 
	    //all accounts.
	    $group->id = 3;
	    $this->Acl->deny($group, 'controllers');        
	    $this->Acl->allow($group, 'controllers/Orders/approval');

	    //all customer services.
	    $group->id = 4;
	    $this->Acl->deny($group, 'controllers');        
	    $this->Acl->allow($group, 'controllers/Orders/validation');
	    
	    //all logistics.
	    $group->id = 5;
	    $this->Acl->deny($group, 'controllers');        
	    $this->Acl->allow($group, 'controllers/Orders/shipping');
	}
	
	
}
?>
