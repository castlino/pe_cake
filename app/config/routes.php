<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	//Router::connect('/', array('controller' => 'products', 'action' => 'index'));


/*
        // Routes for redirecting all public urls to one page., eg. UnderMaintenance page...
        Router::connect('/', array('controller' => 'infos', 'action' => 'siteUnderMaintenance'));
        Router::connect('/orders/shopDeal', array('controller' => 'infos', 'action' => 'siteUnderMaintenance'));
        Router::connect('/orders/expressCheckout/*', array('controller' => 'infos', 'action' => 'siteUnderMaintenance'));
        Router::connect('/orders/cancelPurchase/*', array('controller' => 'infos', 'action' => 'siteUnderMaintenance'));
        Router::connect('/productdeals/*', array('controller' => 'infos', 'action' => 'siteUnderMaintenance'));
        Router::connect('/pastdeals/*', array('controller' => 'infos', 'action' => 'siteUnderMaintenance'));
        Router::connect('/catchupdeals/*', array('controller' => 'infos', 'action' => 'siteUnderMaintenance'));
*/


	Router::connect('/', array('controller' => 'products', 'action' => 'showProduct'));

        Router::connect('/productdeals/:id', array('controller' => 'orders', 'action' => 'shopDeal'), array('pass'=>array('id'), 'id'=>'[a-zA-Z0-9]+'));
        Router::connect('/productdeals', array('controller' => 'products', 'action' => 'showProduct', NULL));

        Router::connect('/pastdeals/:id', array('controller' => 'products', 'action' => 'showProduct'), array('pass'=>array('id'), 'id'=>'[a-zA-Z0-9]+'));
        Router::connect('/pastdeals', array('controller' => 'products', 'action' => 'showProduct'), NULL);

        Router::connect('/catchupdeals/:id', array('controller' => 'products', 'action' => 'catchupDeals'), array('pass'=>array('id'), 'id'=>'[a-zA-Z0-9]+'));
        Router::connect('/catchupdeals', array('controller' => 'products', 'action' => 'showProduct'), NULL);





        /**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
        


        Router::connect('/aboutUs', array('controller' => 'infos', 'action' => 'aboutUs'));
        Router::connect('/termsAndConditions', array('controller' => 'infos', 'action' => 'termsAndConditions'));
        Router::connect('/contactUs', array('controller' => 'infos', 'action' => 'contactUs'));
        
?>
