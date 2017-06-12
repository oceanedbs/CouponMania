<?php

class StaffController extends Zend_Controller_Action
{
        protected $_staffModel;
	protected $_form;
        protected $_authService;
        protected $_radio;



	public function init()
	{
		$this->_helper->layout->setLayout('staff');
		$this->_staffModel = new Application_Model_Staff();
                $this->view->profiloForm = $this->getProfiloForm();
		$this->view->productForm = $this->getProductForm();
                $this->view->selezionaForm = $this->getSelezionaForm();
                $this->view->cambiareprofiloForm = $this->getCambiareprofiloForm();
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
//aggiunta promozioni
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
        //gestione profilo
        public function profiloAction(){
    
    }
private function getProfiloForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Staff_Profile_Profilo();
    		$this->_form->setAction($urlHelper->url(array(
			'controller' => 'staff',
			'action' => 'cambiareprofilo'),
			'default'
		));
		return $this->_form;
    
    }
    //modifica profilo
    public function cambiareprofiloAction() {
    
        
    
    }
    
    private function getCambiareprofiloForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Staff_Profile_Cambiareprofilo();
    		$this->_form->setAction($urlHelper->url(array(
			'controller' => 'staff',
			'action' => 'cambia'),
			'default'
		));
		return $this->_form;
    
    }
    
    public function cambiaAction(){
    
    }

    //visualizzazione promozioni
    public function visualizzapromoAction(){
    $page=null;
    $prodotti=$this->_staffModel->getProds($page);
    
    $this->view->assign(array(
            		'prodotto' => $prodotti,
                        )
            );
		
    }
    private function getSelezionaForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_radio = new Application_Form_Staff_Seleziona();
                
    		$this->_radio->setAction($urlHelper->url(array(
			'controller' => 'staff',
			'action' => 'sel'),
			'default'
		));
		return $this->_radio;
    
    }
    public function selAction(){
    
        
    
        $this->_helper->layout->disableLayout();
    
    }
    
}
