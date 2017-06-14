<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
        protected $_authService;
	protected $_form1;
        protected $_form2;
        protected $_modifica;
        protected $_form3;
        protected $_form4;


        public function init()
	{
	        
                $this->_helper->layout->setLayout('admin');
		$this->_adminModel = new Application_Model_Admin();
                $this->_authService = new Application_Service_Auth();       
                $this->view->staffForm = $this->getStaffForm();
                $this->view->aziendeForm = $this->getAziendeForm();
                $this->view->categoryForm = $this->getCategoryForm();
                if($this->hasParam('piva'))
                $this->view->modificaaziendeForm = $this->getModificaAziendeForm();
                if($this->hasParam('idutente'))
                $this->view->modificautentiForm = $this->getModificaUtenteForm();
                if($this->hasParam('idcat'))
                $this->view->modificacategoryForm = $this->getModificaCategoryForm();
                
	}

	public function indexAction()
	{
          /*  $coupon=$this->_adminModel->numeroCoupon();
            
            $this->view->assign(array(
            		'coupon' => $coupon,)
            		);*/
	
	
	}
	
	public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}

	public function newstaffAction()
	{}

	public function addstaffAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form1;
		if (!$form->isValid($_POST)) {
			return $this->render('newstaff');
		}
		$values = $form->getValues();
		$this->_adminModel->saveStaff($values);
		$this->_helper->redirector('index');
	}

	private function getStaffForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form1 = new Application_Form_Admin_Staff_Add();
		$this->_form1->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'addstaff'),
				'default'
				));
		return $this->_form1;
	}
        
        public function newaziendeAction()
	{}
        
        public function addaziendeAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form2;
		if (!$form->isValid($_POST)) {
			return $this->render('newaziende');
		}
		$values = $form->getValues();
		$this->_adminModel->saveAziende($values);
		$this->_helper->redirector('visualizzaaziende');
	}
        
        
        private function getAziendeForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form2 = new Application_Form_Admin_Aziende_Add();
		$this->_form2->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'addaziende'),
				'default'
				));
		return $this->_form2;
	}
        
      

	
        
        public function modificaaziendeAction(){
    
    }
    public function modificaAction(){
    if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_modifica;
		if (!$form->isValid($_POST)) {
			return $this->render('modificaaziende');
		}
		$values = $form->getValues();
		$this->_adminModel->modificaAziende($values,$this->getParam('piva'));
		$this->_helper->redirector('visualizzaaziende');
    }
private function getModificaAziendeForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_modifica = new Application_Form_Admin_Aziende_Modificaaziende();
		$this->_modifica->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modifica'),
				'default'
				));
                $idazienda=$this->_getParam('piva',null);
                $azienda=$this->_adminModel->getInfoAzienda($idazienda)->current()->toArray();
		return $this->_modifica->populate($azienda);
             
	}

 public function cancellaAction(){
     $this->_adminModel->cancellaAzienda($this->getParam('piva'));
     $this->_helper->redirector('visualizzaaziende');
     
 }


    
    

    //visualizzazione promozioni
    public function visualizzaaziendeAction(){
    $page=null;
    $aziende=$this->_adminModel->getAziende($page);
    
    $this->view->assign(array(
            		'azienda' => $aziende,
                        )
            );
    
		
    }
    
            public function modificautenteAction(){
    
    }
    public function modificauserAction(){
    if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form3;
		if (!$form->isValid($_POST)) {
			return $this->render('modificautenti');
		}
		$values = $form->getValues();
		$this->_adminModel->modificaUtente($values,$this->getParam('idutente'));
		$this->_helper->redirector('visualizzautenti');
    }
private function getModificaUtenteForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form3 = new Application_Form_Admin_Utenti_Modificautenti();
		$this->_form3->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificauser'),
				'default'
				));
                $idutente=$this->_getParam('idutente',null);
                $utente=$this->_adminModel->getInfoUtente($idutente)->current()->toArray();
		return $this->_form3->populate($utente);
             
	}

 public function cancellautenteAction(){
     $this->_adminModel->cancellaUtente($this->getParam('idutente'));
     $this->_helper->redirector('visualizzautenti');
     
 }


    
    

    //visualizzazione promozioni
    public function visualizzautentiAction(){
    $page=null;
    $utenti=$this->_adminModel->getUtentiById($page);
    
    $this->view->assign(array(
            		'utente' => $utenti,
                        )
            );
    
		
    }
    
    public function newcategoryAction()
	{}
        
        public function addcategoryAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form4;
		if (!$form->isValid($_POST)) {
			return $this->render('newcategory');
		}
		$values = $form->getValues();
		$this->_adminModel->saveCategory($values);
		$this->_helper->redirector('visualizzacategory');
	}
        
        
        private function getCategoryForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form4 = new Application_Form_Admin_Category_Add();
		$this->_form4->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'addcategory'),
				'default'
				));
		return $this->_form4;
	}
        
      
    
            public function modificacategoryAction(){
    
    }
    public function modificacatAction(){
    if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form5;
		if (!$form->isValid($_POST)) {
			return $this->render('modificacategory');
		}
		$values = $form->getValues();
		$this->_adminModel->modificaCategory($values,$this->getParam('idcat'));
		$this->_helper->redirector('visualizzacategory');
    }
private function getModificaCategoryForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form5 = new Application_Form_Admin_Category_Modificacategory();
		$this->_form5->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificacat'),
				'default'
				));
                $idcat=$this->_getParam('idcat',null);
                $cat=$this->_adminModel->getInfoCategory($idcat)->current()->toArray();
		return $this->_form5->populate($cat);
             
	}

 public function cancellacategoryAction(){
     $this->_adminModel->cancellaCategory($this->getParam('idcat'));
     $this->_helper->redirector('visualizzacategory');
     
 }


    
    

    //visualizzazione promozioni
    public function visualizzacategoryAction(){
    $page=null;
    $category=$this->_adminModel->getCategory($page);
    
    $this->view->assign(array(
            		'category' => $category,
                        )
            );
}
}