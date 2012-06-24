<?php
/* SVN FILE: $Id$ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('pricesengine'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css('cake.generic');
		//echo $html->css('pricesengine');
		//echo $html->css('jquery-ui-1.8.custom');
                //echo $html->css('countdown');
		
		echo $javascript->link('jquery-1.4.2.min.js');
                //echo $javascript->link('jquery.lwtCountdown-0.9.5.js');
		//echo $javascript->link('pricesengine_default.js');
		
		echo $scripts_for_layout;
		
					
	?>
</head>
<body>
	<div id="container">
            <div id="header" style="background: transparent;">
                <div id="logoDiv">
                      <a href="http://pricesengine.com/" style="float: left; height: 20px;"> <?php echo $html->image("pricesenginelogo.png", array('style'=>'height: 40px;')); ?> </a>
                </div>

		</div>
            <div id="content" style="overflow: visible;">

			<?php //if($noFlash!=1) $session->flash('auth'); ?>
			<?php //if($noFlash!=1) $session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>

		<div id="footerbg">
		</div>
	</div>
	<?php echo $cakeDebug; ?>
</body>
</html>