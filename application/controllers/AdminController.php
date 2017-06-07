<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
	protected $_form;


	public function init()
	{
		$this->_helper->layout->setLayout('admin');
		$this->_adminModel = new Application_Model_Admin();
		$this->view->productForm = $this->getProductForm();
	}

	public function indexAction()
	{}

	public function newproductAction()
	{}

	public function addproductAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form;
		if (!$form->isValid($_POST)) {
			return $this->render('newproduct');
		}
		$values = $form->getValues();
		$this->_adminModel->saveProduct($values);
		$this->_helper->redirector('index');
	}

	private function getProductForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Admin_Product_Add();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'addproduct'),
				'default'
				));
		return $this->_form;
	}
}
