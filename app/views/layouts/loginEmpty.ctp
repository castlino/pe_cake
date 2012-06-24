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
		<?php __('pricesEngine: The quickest way to shop online:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css('cake.generic');
		echo $html->css('pricesengine');
		echo $html->css('jquery-ui-1.8.custom');
		
		echo $javascript->link('jquery-1.4.2.min.js');
		echo $javascript->link('pricesengine_default.js');
		
		echo $scripts_for_layout;
		
					
	?>
</head>
<body>
	<div id="pe_container">
		<div id="pe_header"  >
			<a href="http://pricesengine.com/" style="float: left;"> <?php echo $html->image("pricesenginelogo.png"); ?> </a>
		</div>
		<div id="pe_content">

			<?php $session->flash('auth'); ?>
			<?php $session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>

		<div id="pe_footerbg">
			<div id="footercapDiv">        </div>
			<p class="footer">
			<?php echo "<i><c>".$html->link(
					$html->image('pricesengine.gif', array('alt'=> __("Copyright: pricesEngine 2010", true), 'border'=>"0")),
					'http://pricesengine/',
					array('target'=>'_blank'), null, false
				)."</c></i>";
			?>
			</p>
		</div>
	</div>
	<?php echo $cakeDebug; ?>
</body>
</html>