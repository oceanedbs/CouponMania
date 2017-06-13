<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
        protected $_authService;
	protected $_form1;
        protected $_form2;
        protected $_modifica;


        public function init()
	{
	        
                $this->_helper->layout->setLayout('admin');
		$this->_adminModel = new Application_Model_Admin();
                $this->_authService = new Application_Service_Auth();       
                $this->view->staffForm = $this->getStaffForm();
                $this->view->aziendeForm = $this->getAziendeForm();
                if($this->hasParam('piva'))
                $this->view->modificaaziendeForm = $this->getModificaAziendeForm();
                
	}

	public function indexAction()
	{
            $coupon=$this->_adminModel->numeroCoupon();

            $coupon=$this->_adminModel->numeroCoupon();
            $aziende=$this->_adminModel->numeroAziende();
            $utenti=$this->_adminModel->numeroUtenti();

            
            
            $this->view->assign(array(
            		'coupon' => $coupon,
            		'aziende'=>$aziende,
            		'utenti' => $utenti,)
            		
            		);
	
	
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
	public function statAction()
	{
	}
	public function statisticaAction()
	{
            $mod=$this->_getParam('mod', null);
            $couponutente=array();
            $couponpromo=array();
            
            $utente = $this->_adminModel->getUtente();
                        
            $idutente = $this->_getParam('idutente', null);
            $paged=$this->_getParam('page', null);
            $idpromo = $this ->_getParam('idpromo', null);
            
            $promozioni=$this->_adminModel->getProds($paged);
            
            if($mod == 2){
            
                $couponutente = $this->_adminModel->getCouponUtente($idutente);
            
            }
            else{
            
                $couponpromo = $this->_adminModel->getCouponPromo($idpromo);
            
            }
            $this->view->assign(array(
            		'mod' => $mod,
            		'utente' => $utente,
            		'idutente'=>$idutente,
            		'couponutente' => $couponutente,
            		'promozioni' => $promozioni,
            		'idpromo'=> $idpromo,
                        'couponpromo'=>$couponpromo,)
            		);
            }
}
