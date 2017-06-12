<?php

class StaffController extends Zend_Controller_Action
{
        protected $_staffModel;
	protected $_form1;
	protected $_form2;
	protected $_form3;
	protected $_form4;
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
		$form=$this->_form1;
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
		$this->_form1 = new Application_Form_Staff_Product_Add();
		$this->_form1->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'addproduct'),
				'default'
				));
		return $this->_form1;
	}
        //gestione profilo
        public function profiloAction(){
    
    }
private function getProfiloForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form2 = new Application_Form_Staff_Profile_Profilo();
    		$this->_form2->setAction($urlHelper->url(array(
			'controller' => 'staff',
			'action' => 'cambiareprofilo'),
			'default'
		));
		return $this->_form2;
    
    }
    //modifica profilo
    public function cambiareprofiloAction() {
    
        
    
    }
    
    private function getCambiareprofiloForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form3 = new Application_Form_Staff_Profile_Cambiareprofilo();
    		$this->_form3->setAction($urlHelper->url(array(
			'controller' => 'staff',
			'action' => 'cambia'),
			'default'
		));
		return $this->_form3;
    
    }
    
    public function cambiaAction(){
    
                if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form3;
		if (!$form->isValid($_POST)) {
			return $this->render('cambiareprofilo');
		}
		$values = $form->getValues();
		$this->_staffModel->modficaUtente($values);
		$this->_helper->redirector('index');

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
