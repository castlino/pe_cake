<?php
class OrdersProductsController extends AppController {

	var $name = 'OrdersProducts';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->OrdersProduct->recursive = 0;
		$this->set('ordersProducts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid OrdersProduct.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ordersProduct', $this->OrdersProduct->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->OrdersProduct->create();
			if ($this->OrdersProduct->save($this->data)) {
				$this->Session->setFlash(__('The OrdersProduct has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The OrdersProduct could not be saved. Please, try again.', true));
			}
		}
		$orders = $this->OrdersProduct->Order->find('list');
		$products = $this->OrdersProduct->Product->find('list');
		$this->set(compact('orders', 'products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid OrdersProduct', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->OrdersProduct->save($this->data)) {
				$this->Session->setFlash(__('The OrdersProduct has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The OrdersProduct could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OrdersProduct->read(null, $id);
		}
		$orders = $this->OrdersProduct->Order->find('list');
		$products = $this->OrdersProduct->Product->find('list');
		$this->set(compact('orders','products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for OrdersProduct', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OrdersProduct->del($id)) {
			$this->Session->setFlash(__('OrdersProduct deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>