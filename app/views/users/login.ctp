<h2>Login</h2>
<?php
echo $form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
echo $form->input('User.username');
echo $form->input('User.password');
echo $form->end('Login');
?>

<?php /*
$session->flash('auth');
echo $form->create('User', array('action' => 'login'));
echo $form->inputs(array(
	'legend' => __('Login', true),
	'username',
	'password'
));
echo $form->end('Login');
*/?>