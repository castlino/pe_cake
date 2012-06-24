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
		<?php __('pricesengine.com'); ?>
		<?php //echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css('cake.generic');
		echo $html->css('pricesengine');
		echo $html->css('jquery-ui-1.8.custom');
                echo $html->css('countdown');

		echo $javascript->link('jquery-1.4.2.min.js');
                echo $javascript->link('jquery.lwtCountdown-0.9.5.js');
		echo $javascript->link('pricesengine_default.js');

		echo $scripts_for_layout;


	?>
</head>
<body>
	<div id="pe_container">
		<div id="pe_header"  >
                        <div id="logoDiv">
                            <a href="http://pricesengine.com/" style="float: left;"> <?php echo $html->image("pricesenginelogo.png"); ?> </a>
                        </div>
                        <div id="buttonsDiv">
                            <ul>
				<li id="tbMenu1" class="tabButton"><div id="tbMenuDiv1" class='redButtonDiv' onClick="location.href='/aboutUs'"><span class="alink">About Us</span></div></li>
				<li id="tbMenu2" class="tabButton"><div id="tbMenuDiv2" class='redButtonDiv' onClick="location.href='/termsAndConditions'"><span class="alink">Terms & Conditions</span></div></li>
				<li id="tbMenu3" class="tabButton"><div id="tbMenuDiv3" class='redButtonDiv' onClick="location.href='/contactUs'"><span class="alink">Contact Us</span></div></li>
                            </ul>
                        </div>
		</div>
		<div id="pe_content">
			<?php if($noFlash!=1) $session->flash('auth'); ?>
			<?php if($noFlash!=1) $session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>

		<div id="pe_footerbg">
			<div id="footercapDiv">        </div>
                        <!--
			<p class="footer">
			<?php echo "<i><c>".$html->link(
					$html->image('pricesengine.gif', array('alt'=> __("Copyright: pricesEngine 2010", true), 'border'=>"0")),
					'http://pricesengine/',
					array('target'=>'_blank'), null, false
				)."</c></i>";
			?>
			</p>
                        -->
                    <div id="goToHomeDiv">
                            <?php echo $html->link('Home', array('controller'=>'products', 'action'=>'showProduct')); ?>
                            <span class="footernote">Copyright pricesengine.com Australia</span>
                    </div>
		</div>
	</div>
	<?php echo $cakeDebug; ?>
        <!-- START GetClick Code        -->
            <script type="text/javascript">
            var clicky = { log: function(){ return; }, goal: function(){ return; }};
            var clicky_site_id = 216030;
            (function() {
              var s = document.createElement('script');
              s.type = 'text/javascript';
              s.async = true;
              s.src = ( document.location.protocol == 'https:' ? 'https://static.getclicky.com' : 'http://static.getclicky.com' ) + '/js';
              ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
            })();
            </script>
            <a title="Web Analytics" href="http://getclicky.com/216030"></a>
            <noscript><p><img alt="Clicky" width="1" height="1" src="http://in.getclicky.com/216030ns.gif" /></p></noscript>
        <!-- END GetClick Code        -->

	<!-- START Wibiya Code -->
		<script src='http://cdn.wibiya.com/Toolbars/dir_0402/Toolbar_402118/Loader_402118.js' type='text/javascript'></script>
	<!-- END Wibiya Code   -->
</body>
</html>
