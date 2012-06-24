<?php
class OrdersController extends AppController {

	var $name = 'Orders';
        var $components = array('Paypal','Email','Mailer');
	var $helpers = array('Html', 'Form', 'Javascript');
        var $paginate = array(
                            'limit' => 25,
                            'order' => array(
                                'Order.id' => 'desc'
                            )
                        );
	var $uses = array('Order', 'AusPost', 'OrdersProduct', 'Product');

        
        // Specify the product to Sell here...
        // This will be overrriden by the assignment in beforeFilter....
        var $product_ID = 15;

	
	function beforeFilter(){
		parent::beforeFilter(); 
	        $this->Auth->allowedActions = array('cancelPurchase','shopDeal','expressCheckout',
                                                    'beforeExpressCheckout', 'getShippingEstimate',
                                                    'declinePaymentConfirmAjax', 'validationAjax', 
                                                    'approvalAjax', 'shippingAjax');

                // Assign  active Product to display, as enabled in the Products admin.,
                //$prodArr=$this->Product->find('first', array('conditions' => array('Product.is_active' => 1)));
                $prodArr=$this->Product->find('first', array('conditions' => array('Product.is_main' => 1)));
                $this->product_ID = $prodArr['Product']['id'];
	}
		
	function index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

        function sendTestEmail(){
            $this->Mailer->sendOrderReceive("LiNo<lino@9289.com.au", "LiNo", "3");
        }
        
	function viewPdf($id = null) {
            $this->set('noFlash', 0);

            $this->set('invNum', $id);
            if (!$id) {
                $this->Session->setFlash('Sorry, there was no PDF selected.');
                $this->redirect(array('action'=>'shopDeal'), null, true);
            }
            $OrderToPDF = $this->Order->read(null, $id);
            $Ord_Prod = $this->OrdersProduct->find('first', array('conditions' => array(
                                                            'OrdersProduct.order_id' => $id
                                    )));

            $this->set('OrderToPDF', $OrderToPDF);
            $this->set('Ord_Prod', $Ord_Prod);

            $this->layout = 'pdf'; //this will use the pdf.ctp layout
            $this->render();
        }
	function validationView(){
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}
	
	function shippingView(){
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

	function shippingAjax() {
                $this->layout = 'default_admin';
		$this->set('orderId', $id);

			if($this->data['Order']['Id2Edit'] && $this->data['Order']['invoiceNumber'])
			{
                                $invoiceNumber = $this->data['Order']['invoiceNumber'];
				$arrInputID = explode("_", $this->data['Order']['Id2Edit']);			//explode "invoiceRabbit_N" where [N=1-...], to get the order id.
				$this->Order->read(null, $arrInputID[1]);								//set next input focus.
				$this->Order->saveField('invoice_number', $invoiceNumber);
				$this->set('nextFocus', $arrInputID[0]."_".($arrInputID[1]+1) );
                                $this->set('ajaxShipping', $invoiceNumber);
                                sleep(1);
			}
                        else if($this->data['Order']['Id2Edit'] && $this->data['Order']['trackingCode'])
			{
				$arrInputID = explode("_", $this->data['Order']['Id2Edit']);			//explode "trackingRat_N" where [N=1-...], to get the order id.

                                if($arrInputID!=NULL && $arrInputID!=NULL){
                                        $rawTrackingCode = $this->data['Order']['trackingCode'];
                                        if(strlen($rawTrackingCode)>18){
                                            $courierCompany = "eParcel";
                                            $realTrackingCode = substr($rawTrackingCode, 8, 16);
                                        }else if(strlen($rawTrackingCode)>13){
                                            $courierCompany = "eParcel";
                                            $realTrackingCode = substr($rawTrackingCode, 6);
                                        }else{
                                            $courierCompany = "fastWay";
                                            $realTrackingCode = substr($rawTrackingCode, 0, 12);
                                        }
                                        $this->_createpdf($arrInputID[1], $courierCompany, $realTrackingCode);

                                        //debug($rawTrackingCode);
                                        //debug($courierCompany);
                                        //debug($realTrackingCode);

                                        $selOrder = $this->Order->read(null, $arrInputID[1]);
                                        $this->Order->saveField('tracking_code', $rawTrackingCode);

                                        // Update Stock details...
                                        // NOTE: [stock] won't be updated here, its just the [stock_to_go]
                                        //       and [stock_gone] that needs to update here.
                                        //       [stock] has already been updated by the time the
                                        //       compiler comes here, which was at expressCheckout routine.
                                        //$this->OrdersProduct = null;
                                        $ordProd = $this->OrdersProduct->find('first', array('conditions' => array(
                                                                    'OrdersProduct.order_id' => $arrInputID[1]
                                            )));
                                        //debug($ordProd);
                                        if($ordProd != NULL)    // Just in case there is no orders_products created for this order, we can't edit any product table or else it will create a new one.
                                        {
                                                $this->Product->recursive = 0;
                                                $prod = $this->Product->read(null, $ordProd['OrdersProduct']['product_id']);
                                                //debug($prod);
                                                if($prod != NULL)       // Just in case there is no orders_products created for this order, we can't edit any product table or else it will create a new one.
                                                {
                                                    $stockGone = $prod['Product']['stock_gone'];
                                                    $orderQty = $ordProd['OrdersProduct']['quantity'];

                                                    $stockGone = $stockGone + $orderQty;
                                                    $this->Product->set(array(
                                                                                'stock_gone' => $stockGone
                                                                        ));
                                                    $this->Product->save();

                                                    // Email customer
                                                    $this->Mailer->sendOrderShipped($selOrder['Order']['paypal_firstname']." <".$selOrder['Order']['shipping_email'].">",
                                                                                    $selOrder['Order']['paypal_firstname'],
                                                                                    $selOrder['Order']['lightspeed_orderid'],
                                                                                    $selOrder['Order']['invoice_number'],
                                                                                    $realTrackingCode,
                                                                                    $courierCompany);
                                                    $this->set('ajaxShipping', 'Order successfully saved as SHIPPED...');
                                                }
                                        }
                                }else{
                                     $this->set('ajaxShipping', 'Order id is NULL, CANNOT save data...');
                                }
                        }
                        

                $this->render("shippingAjax", "ajax");

        }

	function shipping($id = null) {
                $this->layout = 'default_admin';
		$this->set('orderId', $id);
		if(!$id){
			if($this->data['Order']['Id2Edit'] && $this->data['Order']['isPacked'])
			{
				$this->Order->read(null, $this->data['Order']['Id2Edit']);
				$this->Order->saveField('is_packed', $this->data['Order']['isPacked']);
			} 
			else if($this->data['Order']['Id2Edit'] && $this->data['Order']['isDispatched'])
			{
				$this->Order->read(null, $this->data['Order']['Id2Edit']);
				$this->Order->saveField('is_dispatched', $this->data['Order']['isDispatched']);
			}
			else if($this->data['Order']['Id2Edit'] && $this->data['Order']['invoiceNumber'])
			{
                                $invoiceNumber = $this->data['Order']['invoiceNumber'];
				$arrInputID = explode("_", $this->data['Order']['Id2Edit']);			//explode "invoiceRabbit_N" where [N=1-...], to get the order id.
				$this->Order->read(null, $arrInputID[1]);								//set next input focus.
				$this->Order->saveField('invoice_number', $invoiceNumber);
				$this->set('nextFocus', $arrInputID[0]."_".($arrInputID[1]+1) );
                                //$this->_createpdf($arrInputID[1]);

			}
			else if($this->data['Order']['Id2Edit'] && $this->data['Order']['trackingCode'])
			{
				$arrInputID = explode("_", $this->data['Order']['Id2Edit']);			//explode "trackingRat_N" where [N=1-...], to get the order id.
                                
                                if($arrInputID!=NULL && $arrInputID!=NULL){
                                        $rawTrackingCode = $this->data['Order']['trackingCode'];
                                        if(strlen($rawTrackingCode)>18){
                                            $courierCompany = "eParcel";
                                            $realTrackingCode = substr($rawTrackingCode, 8, 16);
                                        }else if(strlen($rawTrackingCode)>13){
                                            $courierCompany = "eParcel";
                                            $realTrackingCode = substr($rawTrackingCode, 6);
                                        }else{
                                            $courierCompany = "fastWay";
                                            $realTrackingCode = substr($rawTrackingCode, 0, 12);
                                        }
                                        $this->_createpdf($arrInputID[1], $courierCompany, $realTrackingCode);
                                        
                                        //debug($rawTrackingCode);
                                        //debug($courierCompany);
                                        //debug($realTrackingCode);

                                        $selOrder = $this->Order->read(null, $arrInputID[1]);
                                        $this->Order->saveField('tracking_code', $rawTrackingCode);
                                        $this->set('nextFocus', $arrInputID[0]."_".($arrInputID[1]+1) );			//set next input focus.

                                        // Update Stock details...
                                        // NOTE: [stock] won't be updated here, its just the [stock_to_go]
                                        //       and [stock_gone] that needs to update here.
                                        //       [stock] has already been updated by the time the
                                        //       compiler comes here, which was at expressCheckout routine.
                                        //$this->OrdersProduct = null;
                                        $ordProd = $this->OrdersProduct->find('first', array('conditions' => array(
                                                                    'OrdersProduct.order_id' => $arrInputID[1]
                                            )));
                                        //debug($ordProd);
                                        if($ordProd != NULL)    // Just in case there is no orders_products created for this order, we can't edit any product table or else it will create a new one.
                                        {
                                                $this->Product->recursive = 0;
                                                $prod = $this->Product->read(null, $ordProd['OrdersProduct']['product_id']);
                                                //debug($prod);
                                                if($prod != NULL)       // Just in case there is no orders_products created for this order, we can't edit any product table or else it will create a new one.
                                                {
                                                    $stockGone = $prod['Product']['stock_gone'];
                                                    $orderQty = $ordProd['OrdersProduct']['quantity'];

                                                    $stockGone = $stockGone + $orderQty;
                                                    $this->Product->set(array(
                                                                                //$stockToGoStr => $stockToGo,
                                                                                'stock_gone' => $stockGone
                                                                        ));
                                                    $this->Product->save();

                                                    // Email customer
                                                    $this->Mailer->sendOrderShipped($selOrder['Order']['paypal_firstname']." <".$selOrder['Order']['shipping_email'].">",
                                                                                    $selOrder['Order']['paypal_firstname'],
                                                                                    $selOrder['Order']['lightspeed_orderid'],
                                                                                    $selOrder['Order']['invoice_number'],
                                                                                    $realTrackingCode,
                                                                                    $courierCompany);
                                                    $this->Session->setFlash('Order successfully saved...');
                                                }
                                        }
                                }else{
                                    $this->Session->setFlash('Order id is NULL, cannot save data...');
                                }
                                

			}
			
			
			$this->Order->recursive = 0;

                        $conditions = array(
                                            'Order.is_orderapproved' => '1',
                                            'Order.tracking_code' => NULL
                                        );

                        $this->set('orders', $this->paginate($conditions));
                        
		}else{
			$this->set('order', $this->Order->read(null, $id));
		}
	}

	function approvalAjax() {

                    if($this->data['Order']['Id2Edit'] && $this->data['Order']['isApproved'])
                    {
                            $selOrder = $this->Order->read(null, $this->data['Order']['Id2Edit']);
                            $prev_isApproved = $selOrder['Order']['isApproved'];
                            $this->Order->saveField('is_orderapproved', $this->data['Order']['isApproved']);

                            if($prev_isApproved == NULL)
                            {
                                // Email customer
                                $this->Mailer->sendOrderApproved($selOrder['Order']['paypal_firstname']." <".$selOrder['Order']['shipping_email'].">",
                                                                 $selOrder['Order']['paypal_firstname'],
                                                                 $selOrder['Order']['lightspeed_orderid']);
                            }

                    }

                    $this->set('order', $this->Order->read(null, $id));

                    sleep(1);   //introduce delay to see javascript playing.. =)
                    $this->render("approvalAjax", "ajax");
	}

	function approval($id = null) {
                $this->layout = 'default_admin';
		$this->set('orderId', $id);
		if(!$id){
			if($this->data['Order']['Id2Edit'] && $this->data['Order']['isApproved'])
			{
				$selOrder = $this->Order->read(null, $this->data['Order']['Id2Edit']);
				$this->Order->saveField('is_orderapproved', $this->data['Order']['isApproved']);

                                // Email customer
                                $this->Mailer->sendOrderApproved($selOrder['Order']['paypal_firstname']." <".$selOrder['Order']['shipping_email'].">",
                                                                 $selOrder['Order']['paypal_firstname'],
                                                                 $selOrder['Order']['lightspeed_orderid']);

			}

			$this->Order->recursive = 0;
                        $conditions = array(
                                            'Order.lightspeed_orderid NOT ' => NULL
                                        );
			$this->set('orders', $this->paginate($conditions));
		}else{
			$this->set('order', $this->Order->read(null, $id));
		}
	}

        function validationAjax(){
                if($this->data['Order']['Id2Edit'] && $this->data['Order']['ligthspeedOrderId'])
                {
                        $this->Order->recursive = 1;
                        $selOrder = $this->Order->read(null, $this->data['Order']['Id2Edit']);
                        $prev_lightspeedID = $selOrder['Order']['lightspeed_orderid'];
                        $curr_lightspeedID = $this->data['Order']['ligthspeedOrderId'];
                        $this->Order->saveField('lightspeed_orderid', $curr_lightspeedID);

                        //debug($selOrder);
                        if($prev_lightspeedID == NULL && $curr_lightspeedID < 90001)
                        {
                         //Email customer
                         $this->Mailer->sendOrderProcessed($selOrder['Order']['paypal_firstname']." <".$selOrder['Order']['shipping_email'].">",
                                                          $selOrder['Order']['paypal_firstname'],
                                                          $curr_lightspeedID);
                        }

                        $this->set('ajaxLightspeedOrderId', $curr_lightspeedID);
                }else{
                        $this->set('ajaxLightspeedOrderId', 'Unable to update data...');
                }

                sleep(1);   //introduce delay to see javascript playing.. =)
                $this->set('ajaxLightspeedOrderId', $curr_lightspeedID);
                $this->render("validationAjax", "ajax");
        }

	function validation($id = null) {
                $this->set('noFlash', 0);
                $this->layout = 'default_admin';
		$this->set('orderId', $id);
                debug($this->data);
		if(!$id){
                        if($this->data['Order']['searchString']){
                                $searchStr = "%".$this->data['Order']['searchString']."%";
                                $conditions = array('OR' => array(
                                                                array('Order.lightspeed_orderid LIKE' => $searchStr),
                                                                array('Order.shipping_name LIKE' => $searchStr),
                                                                array('Order.shipping_street_address1 LIKE' => $searchStr),
                                                                array('Order.shipping_street_address2 LIKE' => $searchStr),
                                                                array('Order.shipping_suburb LIKE' => $searchStr),
                                                                array('Order.shipping_postcode LIKE' => $searchStr),
                                                                array('Order.shipping_state LIKE' => $searchStr),
                                                                array('Order.shipping_email LIKE' => $searchStr),
                                                                array('Order.paypal_firstname LIKE' => $searchStr),
                                                                array('Order.paypal_lastname LIKE' => $searchStr),
                                                                array('Order.paypal_payerid LIKE' => $searchStr),
                                                                array('Order.paypal_payerstatus LIKE' => $searchStr),
                                                                array('Order.paypal_paymenttype LIKE' => $searchStr),
                                                                array('Order.paypal_surcharge LIKE' => $searchStr),
                                                                array('Order.shipping_charge LIKE' => $searchStr),
                                                                array('Order.amount_paid LIKE' => $searchStr),
                                                                array('Order.invoice_number LIKE' => $searchStr),
                                                                array('Order.tracking_code LIKE' => $searchStr),
                                                                array('Order.created LIKE' => $searchStr),
                                                                array('Order.modified LIKE' => $searchStr)
                                                            )
                                                    
                                                        
                                              );

                                $this->Order->recursive = 1;
                                $this->set('orders', $this->paginate($conditions));
                        }
                        // Depricated... Replaced by the javascript at validationAjax(above)..
			else if($this->data['Order']['Id2Edit'] && $this->data['Order']['ligthspeedOrderId'])
			{
				$selOrder = $this->Order->read(null, $this->data['Order']['Id2Edit']);
				$this->Order->saveField('lightspeed_orderid', $this->data['Order']['ligthspeedOrderId']);

                                // Email customer
                                $this->Mailer->sendOrderProcessed($selOrder['Order']['paypal_firstname']." <".$selOrder['Order']['shipping_email'].">",
                                                                  $selOrder['Order']['paypal_firstname'],
                                                                  $this->data['Order']['ligthspeedOrderId']);
                                $this->Order->recursive = 1;
                                $this->set('orders', $this->paginate());
			}
                        else{
                                $this->Order->recursive = 1;
                                $this->set('orders', $this->paginate());
                        }
			
                        //$products = $this->afterFind( $this->Order->Product->find('all', array('conditions'=>array('Order.id'=>$id))) );

		}else{
			$this->set('order', $this->Order->read(null, $id));
		}
	}	
	
	function view($id = null) {
                $this->set('noFlash', 0);
                $this->layout = 'default_admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid Order.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('order', $this->Order->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Order->create();
			if ($this->Order->save($this->data)) {
				$this->Session->setFlash(__('The Order has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Order could not be saved. Please, try again.', true));
			}
		}
		$products = $this->Order->Product->find('list');
		$customers = $this->Order->Customer->find('list');
		$this->set(compact('products', 'customers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Order', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Order->save($this->data)) {
				$this->Session->setFlash(__('The Order has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Order->read(null, $id);
		}
		$products = $this->Order->Product->find('list');
		$customers = $this->Order->Customer->find('list');
		$this->set(compact('products','customers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Order', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Order->del($id)) {
			$this->Session->setFlash(__('Order deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function shopDeal($id=NULL){


                $product_id = substr($id, 8);
                if($product_id != $this->product_ID){
                    $this->redirect('/pastdeals/'.$id);
                }

                $this->Session->delete('Link');        // Reset.
                $linkPrefix = strtolower(substr($id, 0, 2));
                if($linkPrefix=="fb"){
                        $this->Session->write('Link.isFromFacebook', 1);
                }else{
                        $this->Session->write('Link.isFromFacebook', 0);
                }

                //$data = $this->data;
                $this->set('noFlash', 1);
                $ProductInfo = $this->Product->read(null, $this->product_ID);

                if($linkPrefix=="fb"){
                    $this->set('isFacebookLink', '1');

                    $stockToSell = $ProductInfo['Product']['stock_sell_target_fb'];
                    $stockSold = $ProductInfo['Product']['stock_to_go_fb'];
                    $stockAvailable = $stockToSell-$stockSold;
                }else{
                    $this->set('isFacebookLink', '0');

                    $stockToSell = $ProductInfo['Product']['stock_sell_target'];
                    $stockSold = $ProductInfo['Product']['stock_to_go'];
                    $stockAvailable = $stockToSell-$stockSold;
                }

                // Get Countdown details...
                $dt = $ProductInfo['Product']['date_to_expire'];
                if($dt==NULL){
                        $dt = date("Y-m-d H:i:s", strtotime("+1 day 12:00:00"));
                }
                $this->set('cd_day',    substr($dt, 8, 2));
                $this->set('cd_month',  substr($dt, 5, 2));
                $this->set('cd_year',   substr($dt, 0, 4));
                $this->set('cd_hour',   substr($dt, 11, 2));
                $this->set('cd_min',    substr($dt, 14, 2));
                $this->set('cd_sec',    substr($dt, 17, 2));

                $this->set('productDetails', $ProductInfo);
                if($stockAvailable>0){
                    $this->set('isStockAvailable', 1);
                }else{
                    $this->set('isStockAvailable', 0);
                }

                

	}

	function paypalError(){
		$this->Session->setFlash('Paypal ERROR...');
		$this->redirect(array('action'=>'index'));
	}

	function cancelPurchase(){
		$this->Session->setFlash('Paypal CANCEL...');
		$this->Session->setFlash('paymentmethod: '.$this->data['Maker']['paymentmethod']);

                $prod_ID = $this->Session->read('Product.id');
                if($prod_ID == NULL){
                    $prod_ID = $this->product_ID;
                }

                $ProdInfo = $this->Product->read(null, $prod_ID);
                //$stock = $ProdInfo['Product']['stock'];
                $stockOnHold = $ProdInfo['Product']['stock_on_hold'];

                $rawDate = substr($ProdInfo['Product']['created'], 2, 8);  //yy-mm-dd
                $rawDateArr = explode('-', $rawDate);
                $dateCreated = $rawDateArr[0].$rawDateArr[1].$rawDateArr[2];

                $isFacebook = $this->Session->read('Link.isFromFacebook');
                if($isFacebook == 1){
                        $stock = $ProdInfo['Product']['stock_fb'];
                        $stockStr = "stock_fb";
                        $redirectUrl = '/productdeals/fb'.$dateCreated.$prod_ID;
                }else{
                        $stock = $ProdInfo['Product']['stock'];
                        $stockStr = "stock";
                        $redirectUrl = '/productdeals/pe'.$dateCreated.$prod_ID;
                }

                    $qtyToCancel = $this->Session->read('Product.quantity');
                    if($qtyToCancel==null){
                        $stock = $stock + 1;
                        $stockOnHold = $stockOnHold - 1;
                    }else{
                        $stock = $stock + $qtyToCancel;
                        $stockOnHold = $stockOnHold - $qtyToCancel;
                    }
                    $this->Product->read(null, $prod_ID);
                    $this->Product->set(array(  $stockStr => $stock,
                                                'stock_on_hold' => $stockOnHold
                                             )
                     );
                    $this->Product->save();
                    //$this->redirect(array('controller'=>'orders','action'=>'shopDeal'));
                    $this->redirect($redirectUrl);
	}
	function declinePaymentConfirmAjax(){

                    $this->Session->delete('Payment.is_valid');        // Reset.
                    $this->Session->write('Payment.is_valid', 0);

                    $this->set('ajaxResult', "Sorry, you've been time out...");
                    $this->render("declinePaymentConfirmAjax", "ajax");
	}
	
//****   Paypal Functions   ****//
	
	function _get($var) {
            return isset($this->params['url'][$var])? $this->params['url'][$var]: null;
	}

        function beforeExpressCheckout($product_id){
            $ProductInfo = $this->Product->read(null, $product_id);

            $stockHld = $ProductInfo['Product']['stock_on_hold'];
            $orderQty = $this->data['Order']['quantity'];

            $isFacebook = $this->Session->read('Link.isFromFacebook');
            if($isFacebook == 1){
                    $stockCnt = $ProductInfo['Product']['stock_fb'];
                    $stockToSell = $ProductInfo['Product']['stock_sell_target_fb'];
                    $stockSold = $ProductInfo['Product']['stock_to_go_fb'];
                    $stockAvl = $stockToSell-$stockSold;

                    $stockStr = "stock_fb";
            }else{
                    $stockCnt = $ProductInfo['Product']['stock'];
                    $stockToSell = $ProductInfo['Product']['stock_sell_target'];
                    $stockSold = $ProductInfo['Product']['stock_to_go'];
                    $stockAvl = $stockToSell-$stockSold;

                    $stockStr = "stock";
            }

            if($orderQty < 1 || $orderQty == NULL){
                $this->set('ajaxResult', 'Invalid quantity specified...');
            } elseif($orderQty > $stockAvl) {
                $this->set('ajaxResult', 'Sorry, there is not enough stock to satisfy that quantity...');
                //$this->set('ajaxResult', 'Sorry, there is not enough stock to satisfy that quantity... ['.$orderQty."][".$stockAvl."]".$product_id);
            } else {
                $stock = $stockCnt - $orderQty;
                $stockOnHold = $stockHld + $orderQty;
                $this->set('ajaxResult', 'success'.'|'.$orderQty);
                $this->Product->set(array(  $stockStr => $stock,
                                            'stock_on_hold' => $stockOnHold
                                         )
                                    );
                $this->Product->save();

		$this->Session->delete('Product');        // Reset.
		$this->Session->write('Product.id',$product_id);
            }
            
            $this->render("beforeExpressCheckout", "ajax");
            //$this->redirect(array('controller'=>'orders','action'=>'shopDeal'));
        }

	function expressCheckout($step=1){
            $this->layout = 'default_millisecond_countdown';
            $this->set('noFlash', 1);
	    //$this->Ssl->force();
	    $this->set('step',$step);
	    //first get a token
	    if ($step==1){
	        // set
                //$prod_ID = $this->product_ID;
                $prod_ID = $this->Session->read('Product.id');
                // Refuse processing url invoked actions... If session is gone, do not continue..
                if($prod_ID==NULL){
                    $this->set('error','1');
                    return;
                }

		$ProductInfo = $this->Product->read(null, $prod_ID);
                $itemPrice = $ProductInfo['Product']['price'];
		//debug($ProductInfo);
		//$this->Session->delete('Product');        // Reset.
		$this->Session->write('Product.price', $itemPrice);
		//$this->Session->write('Product.id',$prod_ID);
                $this->Session->write('Product.no_shipping',$ProductInfo['Product']['no_shippingcharge']);
                $this->Session->write('Product.no_paypalsurcharge',$ProductInfo['Product']['no_paypalsurcharge']);
                $this->Session->write('Product.zero_totalamount',$ProductInfo['Product']['zero_totalamount']);
	        $this->Session->write('Product.quantity', $this->data['Order']['quantity']);

                $this->Session->delete('Payment');        // Reset.
                $this->Session->write('Payment.is_valid', 1);
                
                $itemPrice = $this->Session->read('Product.price');
                // Refuse processing url invoked actions... User needs to click on the Paypal image here to get quantity value.
                if($this->data['Order']['quantity']<1 || $this->data['Order']['quantity']==NULL){
                    $this->set('error','1');
                    return;
                }

                if($itemPrice > 0)
                    $paymentInfo['Order']['theTotal']= $itemPrice;
                else
                    $paymentInfo['Order']['theTotal']= "0.25";        //Just past any value for free products/promotional products with zero price..

                if (preg_match("/dev-pricesengine$/i", $_SERVER['SERVER_NAME'] ) ) {

                        /*  dEv Settings */
                        $paymentInfo['Order']['returnUrl']= "http://dev-pricesengine/orders/expressCheckout/2";
                        $paymentInfo['Order']['cancelUrl']= "http://dev-pricesengine/orders/cancelPurchase";
                }elseif (preg_match("/dev.pricesengine.com$/i", $_SERVER['SERVER_NAME'] ) ) {

                        /*  dEv Settings */
                        $paymentInfo['Order']['returnUrl']= "http://dev.pricesengine.com/orders/expressCheckout/2";
                        $paymentInfo['Order']['cancelUrl']= "http://dev.pricesengine.com/orders/cancelPurchase";
                }elseif (preg_match("/devel.pricesengine.com$/i", $_SERVER['SERVER_NAME'] ) ) {

                        /*  dEv Settings */
                        $paymentInfo['Order']['returnUrl']= "http://devel.pricesengine.com/orders/expressCheckout/2";
                        $paymentInfo['Order']['cancelUrl']= "http://devel.pricesengine.com/orders/cancelPurchase";
                }else{
                        /*  LiVE Settings */
                        $paymentInfo['Order']['returnUrl']= "http://pricesengine.com/orders/expressCheckout/2";
                        $paymentInfo['Order']['cancelUrl']= "http://pricesengine.com/orders/cancelPurchase";
                }
	            
	        // call paypal
	        $result = $this->Paypal->processPayment($paymentInfo,"SetExpressCheckout");
	        $ack = strtoupper($result["ACK"]);
	        //Detect Errors
	        if($ack!="SUCCESS"){
	            $error = $result['L_LONGMESSAGE0'];
                    $this->set('error',$error);
                    return;
                }else {
	            // send user to paypal
	            $this->set('result', $result);

                    //Set Payment validity in refence to countdown...
                    $this->set('isPaymentValid', $this->Session->read('Payment.is_valid'));

	            $this->Session->write('step1res', $result);
	            //debug($result);
	            $token = urldecode($result["TOKEN"]);
	            $payPalURL = PAYPAL_URL.$token;
	            $this->redirect($payPalURL);
	        }
	    }
	    //next have the user confirm
	    elseif($step==2){
                // Refuse processing url invoked actions... Session should still exist.
                if($this->Session->read('Product')==NULL){
                    $this->set('error','1');
                    return;
                }

	        //we now have the payer id and token, using the token we should get the shipping address
	        //of the payer. Compile all the info into the session then set for the view.
	        //Add the order total also
	        $result = $this->Paypal->processPayment($this->_get('token'),"GetExpressCheckoutDetails");
	        $result['PAYERID'] = $this->_get('PayerID');
	        $result['TOKEN'] = $this->_get('token');
	        
	        //Read user specified product purchase quantity.
                $ItemQuantity = $this->Session->read('Product.quantity');

                // Refuse processing url invoked actions...
                if($result['PAYERID']==NULL || $result['TOKEN']==NULL || $ItemQuantity==NULL){
                    $this->set('error','1');
                    return;
                }

                //Calculate shipping and add it to total amount.
	        $aus_post = $this->AusPost->find('first', array('conditions'=>array('AusPost.Pcode'=>$result['SHIPTOZIP'])));
	        $prodItem = $this->Product->read(null, $this->Session->read('Product.id'));

                // See if no shipping charge.
                $itemPrice = $prodItem['Product']['price'];
                if($itemPrice > 0)
                    $ShippingAmount = $this->_calculateShippingPrice($prodItem, $aus_post, $ItemQuantity);
                else
                    $ShippingAmount = 0;

                $noShipping = $this->Session->read('Product.no_shipping');
                if($noShipping == 1){
                    $ShippingAmount = 0;
                }
	        //debug($aus_post);
	        //debug($prodItem);
	        //debug($finalAmount);
	        //debug($ItemQuantity);

                //[$ShippingAmount + ($prodItem['Product']['price'] * $ItemQuantity)] * 0.03;
                if($prodItem['Product']['price'] > 0)
                    $paypalSurcharge = ($ShippingAmount + ($prodItem['Product']['price'] * $ItemQuantity)) * (0.03);
                else
                    $paypalSurcharge = 0;

                $noPaypalSurcharge = $this->Session->read('Product.no_paypalsurcharge');
                if($noPaypalSurcharge == 1){
                    $paypalSurcharge = 0;
                }

	        $result['PAYPALSURCHARGE'] = number_format($paypalSurcharge, 2);
                $result['ORDERITEMPRICE'] = number_format($prodItem['Product']['price'], 2);
	        $result['ORDERITEMQTY'] = $ItemQuantity;
	        $result['ORDERSHIPPING'] = number_format($ShippingAmount, 2);
	        $result['ORDERTOTAL'] = number_format(round($ShippingAmount + ($prodItem['Product']['price']*$ItemQuantity) + $paypalSurcharge, 2), 2);

		// Changed session read to db read to avoid outdated data when 2 or more buyer is in process.
                $result['PRODUCTSTOCK'] = $prodItem['Product']['stock'];		//$this->Session->read('Product.stock');;
                $result['PRODUCTSTOCKTOGO'] = $prodItem['Product']['stock_to_go'];	//$this->Session->read('Product.stock_to_go');;
                $result['PRODUCTSTOCKGONE'] = $prodItem['Product']['stock_gone'];	//$this->Session->read('Product.stock_gone');;

                // Additional Product Info.
                $result['PRODUCTMANUFACTURER'] = $prodItem['Product']['manufacturer'];
                $result['PRODUCTMODEL'] = $prodItem['Product']['model'];
                $result['PRODUCTNAME'] = $prodItem['Product']['name'];

                //Detect errors
	        $ack = strtoupper($result["ACK"]);
	        if($ack!="SUCCESS"){
	            $error = $result['L_LONGMESSAGE0'];
	            $this->set('error',$error);
                    return;
	        }
	        else {
	        	//$this->Session->delete('result');
	            $this->Session->write('result',$result);
	            $this->set('result',$result);

                    //Set Payment validity in refence to countdown...
                    $this->set('isPaymentValid', $this->Session->read('Payment.is_valid'));

	            $this->Session->write('step2res', $result);
	            //$this->set('confirmdata', $result2);
	            //debug("s2: ");
	            //debug($result);
	            
	            /*
	             * Result at this point contains the below fields. This will be the result passed 
	             * in Step 3. I used a session, but I suppose one could just use a hidden field
	             * in the view:[TOKEN] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD]  [PAYERID]
	             * [PAYERSTATUS]  [FIRSTNAME][LASTNAME] [COUNTRYCODE] [SHIPTONAME] [SHIPTOSTREET]
	             * [SHIPTOCITY] [SHIPTOSTATE] [SHIPTOZIP] [SHIPTOCOUNTRYCODE] [SHIPTOCOUNTRYNAME]
	             * [ADDRESSSTATUS] [ORDERTOTAL]
	             */
	        }
	    }
	    //show the confirmation
	    elseif($step==3){
                
                // Refuse processing url invoked actions... Session should still exist.
                if($this->Session->read('Product')==NULL){
                    $this->set('error','1');
                    return;
                }

                $itemPrice = $this->Session->read('Product.price');
                // Refuse processing url invoked actions... Session should still exist.
                if($itemPrice==NULL){
                    $this->set('error','1');
                    return;
                }

                if($itemPrice>0){
                    $result3 = $this->Paypal->processPayment($this->Session->read('result'),"DoExpressCheckoutPayment");
                    $ack = strtoupper($result3["ACK"]);
                }else{
                    $ack = "SUCCESS";
                    $result3['PAYMENTSTATUS']="Completed";
                    $result3['TRANSACTIONID']="None";
                    $result3['CURRENCYCODE']="AUD";
                    $result3['PAYMENTTYPE']="FREE";
                    $result3['AMT']="0";

                }

	        if($ack!="SUCCESS"){
	            $error = $result3['L_LONGMESSAGE0'];
	            $this->set('error','1');
                    return;
	            //debug($error);

	        }
	        else {
	        	$lastResult = $this->Session->read('result');
	        	$lastResult['shipping_contact_number'] = $this->data['Order']['shipping_contact_number'];       // ???
                        $this->set('result',$lastResult);
                        $this->set('result3',$result3);
                        $this->Session->write('step3res', $result3);

                        //debug($this->Session->read('step1res'));
                        //debug($this->Session->read('step2res'));
                        //debug($this->Session->read('step3res'));

                        $step1res = $this->Session->read('step1res');
                        $step2res = $this->Session->read('step2res');
                        $step3res = $this->Session->read('step3res');
                        $prod_ID = $this->Session->read('Product.id');

                        $newOrder['Order']['shipping_name'] = $step2res['SHIPTONAME'];
                        $newOrder['Order']['shipping_street_address1'] = $step2res['SHIPTOSTREET'];
                        $newOrder['Order']['shipping_street_address2'] = $step2res['SHIPTOSTREET2'];
                        $newOrder['Order']['shipping_suburb'] = $step2res['SHIPTOCITY'];
                        $newOrder['Order']['shipping_postcode'] = $step2res['SHIPTOZIP'];
                        $newOrder['Order']['shipping_state'] = $step2res['SHIPTOSTATE'];
                        $newOrder['Order']['shipping_country'] = $step2res['SHIPTOCOUNTRYCODE'];
                        $shippingEmail = $step2res['EMAIL'];
                        $newOrder['Order']['shipping_email'] = $shippingEmail;
                        //$newOrder['Order']['shipping_contact_number'] = $this->data['Order']['shipping_contact_number'];
                        $newOrder['Order']['shipping_contact_number'] = $step2res['PHONENUM'];
                        $newOrder['Order']['shipping_method'] = '';
                        $newOrder['Order']['payment_method'] = '';
                        $newOrder['Order']['currency'] = $step3res['CURRENCYCODE'];
                        $newOrder['Order']['ip_address'] = '';
                        $paypalName = $step2res['FIRSTNAME'];
                        $newOrder['Order']['paypal_firstname'] = $paypalName;
                        $newOrder['Order']['paypal_lastname'] = $step2res['LASTNAME'];
                        $newOrder['Order']['paypal_transid'] = $step3res['TRANSACTIONID'];
                        $newOrder['Order']['paypal_payerid'] = $step2res['PAYERID'];
                        $paypalStatus = $step2res['PAYERSTATUS'];
                        $newOrder['Order']['paypal_payerstatus'] = $paypalStatus;
                        $newOrder['Order']['paypal_transactiontype'] = $step3res['TRANSACTIONTYPE'];
                        $newOrder['Order']['paypal_paymenttype'] = $step3res['PAYMENTTYPE'];
                        $newOrder['Order']['amount_paid'] = $step3res['AMT'];
                        $newOrder['Order']['paypal_surcharge'] = $step2res['PAYPALSURCHARGE'];
                        $newOrder['Order']['shipping_charge'] = $step2res['ORDERSHIPPING'];

                        $ProdInfo = $this->Product->read(null, $prod_ID);
                        $orderQty = $step2res['ORDERITEMQTY'];
                        $stock = $ProdInfo['Product']['stock'];
                        $stockOnHold = $ProdInfo['Product']['stock_on_hold'];
                        //$stockToGo = $ProdInfo['Product']['stock_to_go'];
                        $stockGone = $ProdInfo['Product']['stock_gone'];


                        $isFacebook = $this->Session->read('Link.isFromFacebook');
                        if($isFacebook == 1){
                                $stockToGo = $ProdInfo['Product']['stock_to_go_fb'];
                                $stockStr = "stock_to_go_fb";
                        }else{
                                $stockToGo = $ProdInfo['Product']['stock_to_go'];
                                $stockStr = "stock_to_go";
                        }

                        //$stock = $stock - $orderQty;
                        $stockOnHold = $stockOnHold - $orderQty;
                        $stockToGo = $stockToGo + $orderQty;

	            
                        //debug($newOrder);
		        $this->Order->create();
			if ($this->Order->save($newOrder)) {
					//$this->Session->setFlash(__('The Order has been saved', true));
                                        $newOrdersProduct['OrdersProduct']['order_id'] = $this->Order->id;
                                        $newOrdersProduct['OrdersProduct']['product_id'] = $prod_ID;
                                        $newOrdersProduct['OrdersProduct']['quantity'] = $orderQty;
                                        $this->OrdersProduct->create();
                                        if ($this->OrdersProduct->save($newOrdersProduct)) {
                                                        // Update Product stock details....
                                                        $this->Product->read(null, $prod_ID);
                                                        $this->Product->set(array(  'stock_on_hold' => $stockOnHold,
                                                                                    $stockStr => $stockToGo
                                                                                  )
                                                                            );
                                                        $this->Product->save();
                                                        //$this->Session->setFlash(__('The Order-Product has been saved', true));

                                                        //send email to Buyer.
                                                        $this->Mailer->sendOrderReceived($paypalName." <".$shippingEmail.">",
                                                                                         $paypalName,
                                                                                         $this->Order->id,
                                                                                         $paypalStatus);


                                        } else {
                                                        $this->Session->setFlash(__('The Order-Product could not be saved. Please, try again.', true));
                                                        $this->set('error','1');
                                        }


			} else {
					//$this->Session->setFlash(__('The Order could not be saved. Please, try again.', true));
                                        $this->set('error','1');
			}
	            
	            //debug($newOrdersProduct);
	        }
	    }
	}
	
	function _calculateShippingPrice($productItem, $shippingRate, $qty=1){
				/* Price-Shipping Calculation
				 *     FinalAmount = ItemPrice + [ ItemWeight x ShippingRatePerKilo x Quantity] + ShippingRatePerBox
				 */
                                $weightInInt = round($productItem['Product']['weight']);    // Weight should be considered up to the next integer. eg. 2.35kg => 3kg.
                                $ratePerKilo = $shippingRate['AusPost']['per_kilo'];
                                $rateFromSydney = $shippingRate['AusPost']['rate_from_sydney'];
                                
				$totShipping = ($weightInInt*$ratePerKilo*$qty) + $rateFromSydney;
				return $totShipping;
	}

        function getShippingEstimate($product_id){
                $pCode = $this->data['Order']['postcode'];
                $aus_post = $this->AusPost->find('first', array('conditions'=>array('AusPost.Pcode'=>$pCode)));
	        $prodItem = $this->Product->read(null, $product_id);

                // See if no shipping charge.
                $ShippingAmount = $this->_calculateShippingPrice($prodItem, $aus_post);
                $this->set('shippingEstimate',$ShippingAmount);

                $this->render("getShippingEstimate", "ajax");
        }

//****   End of Paypal Functions   ****//
/*
//After Express Checkout Submit
Array
(
    [TOKEN] => EC-46W453399F748051N
    [TIMESTAMP] => 2010-04-28T02:15:12Z
    [CORRELATIONID] => 6a624e07491db
    [ACK] => Success
    [VERSION] => 3.0
    [BUILD] => 1268624
)
 */
/*
//Before Confirm
Array
(
    [TOKEN] => EC-46W453399F748051N
    [TIMESTAMP] => 2010-04-28T02:16:04Z
    [CORRELATIONID] => bbc4a01484be4
    [ACK] => Success
    [VERSION] => 3.0
    [BUILD] => 1268624
    [EMAIL] => astlin_1271809045_per@yahoo.com
    [PAYERID] => CWZHJ2AFD4SEE
    [PAYERSTATUS] => unverified
    [FIRSTNAME] => Test
    [LASTNAME] => User
    [COUNTRYCODE] => AU
    [SHIPTONAME] => Felino Castro
    [SHIPTOSTREET] => unit 35
    [SHIPTOSTREET2] => 159 Epping Road
    [SHIPTOCITY] => Macquarie Park
    [SHIPTOSTATE] => New South Wales
    [SHIPTOZIP] => 2113
    [SHIPTOCOUNTRYCODE] => AU
    [SHIPTOCOUNTRYNAME] => Australia
    [ADDRESSSTATUS] => Unconfirmed
    [ORDERTOTAL] => 9.94
)
*/
/*
// After Confirm
Array
(
    [TOKEN] => EC-46W453399F748051N
    [TIMESTAMP] => 2010-04-28T02:16:14Z
    [CORRELATIONID] => ce9f398bd734e
    [ACK] => Success
    [VERSION] => 3.0
    [BUILD] => 1268624
    [TRANSACTIONID] => 0YY11564AT210343X
    [TRANSACTIONTYPE] => expresscheckout
    [PAYMENTTYPE] => instant
    [ORDERTIME] => 2010-04-28T02:16:13Z
    [AMT] => 9.94
    [FEEAMT] => 0.54
    [TAXAMT] => 0.00
    [CURRENCYCODE] => AUD
    [PAYMENTSTATUS] => Completed
    [PENDINGREASON] => None
    [REASONCODE] => None
)


)
*/

        function _createpdf($orderID = NULL, $courierCompany, $realTrackingCode) {

                $OrderToPDF = $this->Order->read(null, $orderID);
                $Ord_Prod = $this->OrdersProduct->find('first', array('conditions' => array(
                                                            'OrdersProduct.order_id' => $orderID
                                    )));
                //debug($Ord_Prod);
                //debug($OrderToPDF);

                App::import('Vendor','tcpdf/tcpdf');
                $tcpdf = new TCPDF();
                    $textfont = 'helvetica';

                    $tcpdf->SetAuthor("pricesengine.com");
                    $tcpdf->SetAutoPageBreak(true);

                    $tcpdf->setPrintHeader(false);
                    $tcpdf->setPrintFooter(false);

                    $tcpdf->SetTextColor(0, 0, 0);
                    $tcpdf->SetFont($textfont,'',9);

                    $tcpdf->AddPage();

                    //$tcpdf->setJPEGQuality(75);
                    $tcpdf->Image('img/pricesenginelogo.png', 10, 5, 50, 18, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);

                    $tcpdf->SetFont('times', 'B', 20);
                    //$tcpdf->Write(0, 'Tax Invoice', '', 0, 'C', 1, 0, false, false, 0);
                    $tcpdf->MultiCell(80, 5, 'Tax Invoice', 0, 'C', 0, 0, 70, '', true);

                    $tcpdf->SetFont('times', 'BI', 15);
                    $tcpdf->MultiCell(50, 5, 'Number: '.$OrderToPDF['Order']['invoice_number'], 0, 'R', 0, 0, 150, '', true);

                    $tcpdf->SetFont('times', 'BI', 10);
                    $tcpdf->MultiCell(80, 5, 'http://www.pricesengine.com', 0, 'L', 0, 1, 10, 22, true);

                    $tcpdf->SetFont('times', '', 10);
                    $tcpdf->MultiCell(55, 5, "\n"."\n"."\n"."\n"."Invoice Date: ".date("d/m/Y", strtotime('now'))."\n".'ABN 66 128 917 680'
                                        , 0, 'L', 0, 0, '', '', true);

                    $tcpdf->SetFont('times', '', 10);
                    $tcpdf->MultiCell('', 30, " "."\n"."\n"."Unit 207"."\n"."354 Eastern Valley Way,"."\n"."Chatswood, 2067"."\n"."sales@pricesengine.com.au"
                                        , 0, 'R', 0, 0, '', '', true);


                    $tcpdf->Line(10, 57, 200, 57);

                    $yPos = 60;
                    $xPos = 10;

                    $tcpdf->SetFillColor(255, 255, 127);
                    $tcpdf->SetFont('times', 'B', 12);
                    $tcpdf->MultiCell(94, 10, "BILL TO"."\n"."\n", 'LTR', 'L', 1, 0, $xPos, $yPos, true);
                    $tcpdf->SetFont('times', '', 12);
                    $tcpdf->MultiCell(94, 40, $OrderToPDF['Order']['paypal_firstname']." ".$OrderToPDF['Order']['paypal_lastname']."\n".
                                              $OrderToPDF['Order']['shipping_street_address1']." ".$OrderToPDF['Order']['shipping_street_address2']."\n".
                                              $OrderToPDF['Order']['shipping_suburb']." ".$OrderToPDF['Order']['shipping_postcode']."\n".
                                              $OrderToPDF['Order']['shipping_state']."\n"."\n".
                                              "email:   ".$OrderToPDF['Order']['shipping_email']
                                        , 'LRB', 'L', 1, 0, $xPos, $yPos+10, true);

                    $tcpdf->SetFont('times', 'B', 12);
                    $tcpdf->MultiCell(94, 10, "SHIP TO"."\n"."\n", 'LTR', 'L', 1, 0, $xPos+96, $yPos, true);
                    $tcpdf->SetFont('times', '', 12);
                    $tcpdf->MultiCell(94, 40, $OrderToPDF['Order']['shipping_name']."\n".
                                              $OrderToPDF['Order']['shipping_street_address1']." ".$OrderToPDF['Order']['shipping_street_address2']."\n".
                                              $OrderToPDF['Order']['shipping_suburb']." ".$OrderToPDF['Order']['shipping_postcode']."\n".
                                              $OrderToPDF['Order']['shipping_state']."\n"."\n".
                                              "email:   ".$OrderToPDF['Order']['shipping_email']
                                        , 'LRB', 'L', 1, 0, $xPos+96, $yPos+10, true);



                    //Allocation of spaces for purchase details
                    $xPos = 10;
                    $prodCode_xPos = 10;                        //w=40
                    $prodDesc_xPos = $xPos + 40;                //w=80
                    $prodQnty_xPos = $prodDesc_xPos + 80;       //w=20
                    $prodPrice_xPos = $prodQnty_xPos + 20;      //w=20
                    $prodTotal_xPos = $prodPrice_xPos + 20;     //w=40

                    // Product/Item details...
                    $yPos = 115;
                    $tcpdf->SetFillColor(204, 204, 204);
                    $tcpdf->SetFont('times', 'B', 10);
                    $tcpdf->MultiCell(40, 25, 'Product', 0, 'L', 1, 1, $prodCode_xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 25, 'Description/Name', 0, 'L', 1, 0, $prodDesc_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 25, 'Qty', 0, 'C', 1, 0, $prodQnty_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 25, 'Item Price (GST inc.)', 0, 'R', 1, 0, $prodPrice_xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 25, 'Subtotal', 0, 'R', 1, 0, $prodTotal_xPos, $yPos, true);

                    $tcpdf->SetFillColor(204, 255, 255);
                    $yPos = $yPos + 12;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->MultiCell(40, 20, $OrderToPDF['Product'][0]['model'], 'B', 'L', 1, 1, $prodCode_xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 20,
                                              //'27" Samsung TV Series 8, '."\n".
                                              //'Ports: hdmi vga dvi,'."\n".
                                              strip_tags($OrderToPDF['Product'][0]['name']), 'B', 'L', 1, 0, $prodDesc_xPos, $yPos, true);

                    $ProdPrice = $OrderToPDF['Product'][0]['price'];
                    $ProdQty = $Ord_Prod['OrdersProduct']['quantity'];
                    $TotProdQtyPrice = $ProdQty * $ProdPrice;
                    $tcpdf->MultiCell(20, 20, $ProdQty, 'B', 'C', 1, 0, $prodQnty_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 20, number_format($ProdPrice, 2), 'B', 'R', 1, 0, $prodPrice_xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 20, number_format($TotProdQtyPrice, 2), 'B', 'R', 1, 0, $prodTotal_xPos, $yPos, true);


                    // Shipping details...
                    $yPos = $yPos + 20;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->MultiCell(40, 10, 'Shipping', 'B', 'L', 1, 1, $prodCode_xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 10, 'Shipping Rate', 'B', 'L', 1, 0, $prodDesc_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 10, $ProdQty, 'B', 'C', 1, 0, $prodQnty_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 10, number_format($OrderToPDF['Order']['shipping_charge'], 2), 'B', 'R', 1, 0, $prodPrice_xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 10, number_format($OrderToPDF['Order']['shipping_charge'], 2), 'B', 'R', 1, 0, $prodTotal_xPos, $yPos, true);

                    // Paypal details...
                    $yPos = $yPos + 10;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->MultiCell(40, 10, 'Service', 'B', 'L', 1, 1, $prodCode_xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 10, 'Paypal Surcharge', 'B', 'L', 1, 0, $prodDesc_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 10, '1', 'B', 'C', 1, 0, $prodQnty_xPos, $yPos, true);                    //Always 1...
                    $tcpdf->MultiCell(20, 10, number_format($OrderToPDF['Order']['paypal_surcharge'], 2), 'B', 'R', 1, 0, $prodPrice_xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 10, number_format($OrderToPDF['Order']['paypal_surcharge'], 2), 'B', 'R', 1, 0, $prodTotal_xPos, $yPos, true);

                    // Payment details...
                    $yPos = $yPos + 20;
                    $tcpdf->SetFont('courier', 'B', 10);
                    $tcpdf->MultiCell(40, 10, 'Payment details', '0', 'L', 0, 1, $prodCode_xPos, $yPos, true);
                    $yPos = $yPos + 5;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->MultiCell(20, 10, 'Paypal', '0', 'L', 0, 1, $xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 10, date("d/m/Y", strtotime($OrderToPDF['Order']['modified'])), '0', 'L', 0, 1, $xPos+20, $yPos, true);
                    $tcpdf->MultiCell(50, 10, 'Order ID: O-'.$OrderToPDF['Order']['lightspeed_orderid'], '0', 'L', 0, 1, $xPos+50, $yPos, true);

                    // Shipping details...
                    $yPos = $yPos + 20;
                    $tcpdf->SetFont('courier', 'B', 10);
                    $tcpdf->MultiCell(40, 10, 'Shipping details', '0', 'L', 0, 1, $prodCode_xPos, $yPos, true);
                    $yPos = $yPos + 5;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->SetFont('courier', '', 10);

                    $rawTrackingCode = $OrderToPDF['Order']['tracking_code'];
                    if($courierCompany == "eParcel"){
                              $courierWebsite = "http://auspost.com.au/";
                    }else{    //"fastWay"
                              $courierWebsite = "http://fastway.com.au/";
                    }
                    $tcpdf->MultiCell(30, 10, $courierCompany, '0', 'L', 0, 1, $xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 10, "Tracking Number: ".$realTrackingCode."\n".$courierWebsite, '0', 'L', 0, 1, $xPos+35, $yPos, true);


                    // Total details...
                    $yPos = $yPos + 20;
                    $tcpdf->SetFont('courier', 'B', 10);
                    $tcpdf->MultiCell(40, 6, 'Total:', 'B', 'R', 0, 1, $prodTotal_xPos-40, $yPos, true);

                    $shippingCharge = $OrderToPDF['Order']['paypal_surcharge'];
                    $paypalCharge = $OrderToPDF['Order']['shipping_charge'];
                    $totalAmountDue = $TotProdQtyPrice + $shippingCharge + $paypalCharge;
                    $tcpdf->MultiCell(30, 6, number_format($totalAmountDue, 2), 'B', 'R', 0, 0, $prodTotal_xPos, $yPos, true);
                    $yPos = $yPos + 10;
                    $tcpdf->MultiCell(40, 6, 'Payment:', 'B', 'R', 0, 1, $prodTotal_xPos-40, $yPos, true);
                    $tcpdf->MultiCell(30, 6, number_format($OrderToPDF['Order']['amount_paid'], 2), 'B', 'R', 0, 0, $prodTotal_xPos, $yPos, true);

                // create some HTML content
                /*
                    $htmlcontent =
                        "
                            <table>accounts@9289.co
                                <tr>
                                    <td>".$html->image("pricesenginelogo.png", array("width"=>"100px"))."</td>
                                    <td><span style='font-size: 17px;'>Tax Invoice</span></td>
                                    <td>Invoice Number:".$invNum."</td>
                                </tr>
                            </table>
                        ";
                    // output the HTML content
                    //$tcpdf->writeHTML($htmlcontent, true, 0, true, 0);
                */
                    //$tcpdf->Output('filename.pdf', 'D');
                    $tcpdf->Output("pdfinv/invoice_".$OrderToPDF['Order']['invoice_number'].".pdf", "F");
        }

	
}
?>
