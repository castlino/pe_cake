<?php
class AppController extends Controller {
    var $components = array('Acl', 'Auth', 'Email');
    var $helpers = array('Html','Javascript');

    function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->authorize = 'actions';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'products', 'action' => 'index');
        
        $this->Auth->actionPath = 'controllers/';		//  AuthComponent needs to know about the existence of this 
        												//root node, so that when making ACL checks it can use 
        												//the correct node path when looking up controllers/actions.
        												
        $this->Auth->allowedActions = array('display');	//  This makes the 'display' action public. This will 
        												//keep our PagesController::display() public. This is 
        												//important as often the default routing has this action 
        												//as the home page for you application.
	//$javascript->link('pricesengine_default');
    }
    
    function _emailSomeone(){
    	$this->Email->from    = 'Admin <admin@pricesengine.com>';
		$this->Email->to      = 'You <lino@9289.com.au>';
		$this->Email->subject = 'Test';
		$this->Email->send("Hello there...!"."\n"." how are you? "."\n"."we hope you are doing great!");    	
    }
}
?>
