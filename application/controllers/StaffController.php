<?php

class StaffController extends Zend_Controller_Action
{
        protected $_staffModel;
	protected $_form;
        protected $_authService;



	public function init()
	{
		$this->_helper->layout->setLayout('staff');
		$this->_staffModel = new Application_Model_Staff();
		$this->view->productForm = $this->getProductForm();
        $this->_authService = new Application_Service_Auth();       
                
	}

	public function indexAction()
	{
          
        }
        
        public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}

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
		$this->_staffModel->saveProduct($values);
		$this->_helper->redirector('index');
	}

	private function getProductForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Staff_Product_Add();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'addproduct'),
				'default'
				));
		return $this->_form;
	}
}