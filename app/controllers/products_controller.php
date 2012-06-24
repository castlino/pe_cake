<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $helpers = array('Html', 'Form');
        var $paginate = array(
                            'limit' => 25,
                            'order' => array(
                                'Product.id' => 'desc'
                            )
                        );

	function beforeFilter() {
	    parent::beforeFilter(); 
	    $this->Auth->allowedActions = array('activateProduct', 'showProduct', 'setMainProduct', 'catchupDeals');
	}
	
	function index() {
                $this->set('noFlash', 0);
                $this->layout = 'default_admin';
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	function setMainProduct() {
                $checkBoxID = $this->data['Product']['checkBoxIsMain_id'];
                $temp = explode("_",$checkBoxID);
                $prodID = $temp[1];

                $this->Product->updateAll(array('Product.is_main' => 0), array('Product.is_main' => 1));
                $this->Product->read(null, $prodID);
                $this->Product->set('is_main', '1');
                $this->Product->save();

                $this->set('prodID', $prodID);
                $this->render("set_main_product", "ajax");
	}

	function activateProduct($val) {
                $checkBoxID = $this->data['Product']['checkBoxIsActive_id'];
                $temp = explode("_",$checkBoxID);
                $prodID = $temp[1];

                //$this->Product->updateAll(array('Product.is_active' => 0), array('Product.is_active' => 1));
                $this->Product->read(null, $prodID);
                $this->Product->set('is_active', $val);
                $this->Product->save();

                $this->set('prodID', $prodID);
                $this->render("activate_product", "ajax");
	}

	function view($id = null) {
                $this->set('noFlash', 0);
                $this->layout = 'default_admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid Product.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	function add() {
                $this->set('noFlash', 0);
                $this->layout = 'default_admin';
                //debug($this->data);
                
		if (!empty($this->data)) {
                        //Get next id
                        $findRes = $this->Product->find('first', array('fields'=>'id', 'order'=>'Product.id DESC'));
                        $lastID = $findRes['Product']['id'];
                        $nextID = $lastID + 1;

                        // Save uploaded products
                        for($x=1;$x<7;$x++)
                        {
                            if($this->data['Product']['imageviewarr_'.$x]['name']){
                                $file =$this->data['Product']['imageviewarr_'.$x]['name'];
                                $fileExt = substr($file, strlen($file)-4);
                                $newFName = "p".$nextID."_img".$x.$fileExt;
                                if($x==6){
                                    $this->data['Product']['imageview_fb'] = $newFName;
                                }else{
                                    $this->data['Product']['imageview_'.$x] = $newFName;
                                }

                                move_uploaded_file($this->data['Product']['imageviewarr_'.$x]['tmp_name'], "img/product_images/".$newFName);
                            }
                        }

                        $dateExpiry = $this->data['Product']['date']." 12:00:00";
                        $this->data['Product']['date_to_expire'] = $dateExpiry;

                        $this->data['Product']['stock_to_go'] = 0;
                        $this->data['Product']['stock_to_go_fb'] = 0;
                        $this->data['Product']['stock_sell_target'] = $this->data['Product']['stock'];
                        $this->data['Product']['stock_sell_target_fb'] = $this->data['Product']['stock_fb'];

			$this->Product->create();
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The Product has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.', true));
			}
		}

		$orders = $this->Product->Order->find('list');
		$this->set(compact('orders'));
	}

	function edit($id = null) {
                $this->set('noFlash', 0);
                $this->layout = 'default_admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Product', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {

                        if($this->data['Product']['date']!=null){
                            $dateExpiry = $this->data['Product']['date']." 12:00:00";
                        }else{
                            $dateExpiry = date("Y-m-d")." 12:00:00";
                        }
                        
                        $this->data['Product']['date_to_expire'] = $dateExpiry;

			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The Product has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);

                        if($this->data['Product']['date_to_expire']!=null){
                            $arrDateExpiry = explode(" ", $this->data['Product']['date_to_expire']);
                            $this->data['Product']['date'] = $arrDateExpiry[0];
                        }else{
                            $this->data['Product']['date'] = '';
                        }
		}
		$orders = $this->Product->Order->find('list');
		$this->set(compact('orders'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->del($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

        function showProduct($id=NULL){
            if($id == NULL){

                // Assign  active Product to display, as enabled in the Products admin.,
                //$prodArr=$this->Product->find('first', array('conditions' => array('Product.is_active' => 1)));
                $prodArr=$this->Product->find('first', array('conditions' => array('Product.is_main' => 1)));
                $activeProduct_ID = $prodArr['Product']['id'];

                //Get Date
                $rawDate = substr($prodArr['Product']['created'], 2, 8);  //yy-mm-dd
                $rawDateArr = explode('-', $rawDate);
                $dateCreated = $rawDateArr[0].$rawDateArr[1].$rawDateArr[2];

                $this->redirect('/productdeals/'.'pe'.$dateCreated.$activeProduct_ID);

            }else{
                //$this->layout = 'default_no_countdown';
                $this->layout = 'default_disable_purchase';
                $this->set('noFlash', 1);


                $product_id = substr($id, 8);
		$ProductInfo = $this->Product->read(null, $product_id);
                if($ProductInfo == NULL){
                    $this->redirect('/productdeals/');          // Redirect to main deal.
                }else{
                    $urlDate = substr($id, 2, 6);
                    //Get Date
                    $rawDate = substr($ProductInfo['Product']['created'], 2, 8);  //yy-mm-dd
                    $rawDateArr = explode('-', $rawDate);
                    $dateCreated = $rawDateArr[0].$rawDateArr[1].$rawDateArr[2];
                    if($urlDate != $dateCreated){
                        $this->redirect('/productdeals/');      // Redirect to main deal.
                    }

                    if($ProductInfo['Product']['is_active']==1){
                        debug($ProductInfo['Product']['is_active']);
                        $this->redirect('/catchupdeals/'.$id);      // Redirect to catchupDeals.
                    }
                }

                // Show pastdeals here...
		$this->set('productDetails', $ProductInfo);

            }
        }

        function catchupDeals($id=NULL){
                $this->layout = 'default_no_countdown';
                $this->set('noFlash', 1);

                $product_id = substr($id, 8);
		$ProductInfo = $this->Product->read(null, $product_id);
                if($ProductInfo == NULL){
                    $this->redirect('/productdeals/');          // Redirect to main deal.
                }else{
                    $urlDate = substr($id, 2, 6);
                    //Get Date
                    $rawDate = substr($ProductInfo['Product']['created'], 2, 8);  //yy-mm-dd
                    $rawDateArr = explode('-', $rawDate);
                    $dateCreated = $rawDateArr[0].$rawDateArr[1].$rawDateArr[2];
                    if($urlDate != $dateCreated){
                        $this->redirect('/productdeals/');      // Redirect to main deal.
                    }
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
                $ProductInfo = $this->Product->read(null, $product_id);

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
                $this->set('productDetails', $ProductInfo);
                if($stockAvailable>0){
                    $this->set('isStockAvailable', 1);
                }else{
                    $this->set('isStockAvailable', 0);
                }

        }



}
?>