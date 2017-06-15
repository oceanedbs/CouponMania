<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
        protected $_authService;
	protected $_newstaff;
        protected $_newazienda;
        protected $_modifica;
        protected $_form3;
        protected $_form4;
        protected $_form5;
        protected $_form6;
        protected $_form7;
        
        
        

        protected $_updateuser;

        protected $_faq;
         protected $_newfaq;



        public function init()
	{
	        
                $this->_helper->layout->setLayout('admin');
		$this->_adminModel = new Application_Model_Admin();
                $this->_authService = new Application_Service_Auth();       
                $this->view->staffForm = $this->getStaffForm();
                $this->view->aziendeForm = $this->getAziendeForm();
                $this->view->categoryForm = $this->getCategoryForm();
                $this->view->newfaqForm=$this->newfaqAction();
             

                
                
                if($this->hasParam('piva'))
                $this->view->modificaaziendeForm = $this->getModificaAziendeForm();
                 if($this->hasParam('idfaq'))
 
                $this->view->modificafaqpost = $this->modificafaqAction();
 
                if($this->hasParam('idutente'))
                $this->view->modificautentiForm = $this->getModificaUtenteForm();
                if($this->hasParam('idcat'))
                $this->view->modificacategoryForm = $this->getModificaCategoryForm();
                
                   if($this->hasParam('idstaff'))
                $this->view->permessiForm= $this->getPermessiForm();
                
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
		$form=$this->_newstaff;
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
		$this->_newstaff = new Application_Form_Admin_Staff_Add();
		$this->_newstaff->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'addstaff'),
				'default'
				));
		return $this->_newstaff;
	}
        
        public function newaziendeAction()
	{}
        
        public function addaziendeAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_newazienda;
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
		$this->_newazienda = new Application_Form_Admin_Aziende_Add();
		$this->_newazienda->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'addaziende'),
				'default'
				));
		return $this->_newazienda;
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
    $paged=$this->_getParam('page', 0);
    $aziende=$this->_adminModel->getAziende($paged);
    
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
		$form=$this->_updateuser;
		if (!$form->isValid($_POST)) {
			return $this->render('modificautenti');
		}
		$values = $form->getValues();
		$this->_adminModel->modificaUtente2($values,$this->getParam('idutente'));
		$this->_helper->redirector('visualizzautenti');
    }
    private function getModificaUtenteForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_updateuser = new Application_Form_Admin_Utenti_Modificautenti();
		$this->_updateuser->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificauser'),
				'default'
				));
                $idutente=$this->_getParam('idutente',null);
                $utente=$this->_adminModel->getInfoUtente2($idutente)->current()->toArray();		
                return $this->_updateuser->populate($utente);
             
	}

 public function cancellautenteAction(){
     $this->_adminModel->cancellaUtente($this->getParam('idutente'));
     $this->_helper->redirector('visualizzautenti');
     
 }


    
    

    //visualizzazione utenti
    public function visualizzautentiAction(){
    $paged=$this->_getParam('page', 1);
    $utenti=$this->_adminModel->getUtentiById($paged);
    
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
    $paged=$this->_getParam('page', 0);
    $category=$this->_adminModel->getCategory($paged);
    
    $this->view->assign(array(
            		'category' => $category,
                        )
            );
}

public function newstaffpermessiAction()
	{}
        
        public function addpermessiAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form6;
		if (!$form->isValid($_POST)) {
			return $this->render('newstaffpermessi');
		}
		$values = $form->getValues();
		$this->_adminModel->savePermesso($values);
		$this->_helper->redirector('visualizzapermessi');
	}
        
        
        private function getPermessiForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form6 = new Application_Form_Admin_Permessi_Add();
		$this->_form6->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'addpermessi'),
				'default'
				));
                $idstaff=$this->_getParam('idstaff',null);
                $aziende=$this->_adminModel->getAziendeStaff($idstaff)->toArray();
                print_f($aziende);die;
                               
		return $this->_form6->populate($aziende);
	}
        
      
    
            public function modificapermessiAction(){
    
    }
   


 public function cancellapermessiAction(){
     $this->_adminModel->cancellaPermessi($this->getParam('idstaff'));
     $this->_helper->redirector('visualizzapermessi');
     
 }


    
    

    //visualizzazione permessi
    public function visualizzapermessiAction(){
       $idutente=$this->_getParam('idstaff',null); 
    $permessi=$this->_adminModel->getInfoPermessi($idutente)->current()->toArray();
    
    $this->view->assign(array(
            		'permessi' => $permessi,
                        )
            );
}
   public function visualizzastaffAction(){
    $staff=$this->_adminModel->getStaff();
    
    $this->view->assign(array(
            		'staff' => $staff,
                        )
            );
}

    public function visualizzafaqAction(){
 
                $paged=$this->_getParam('page', 1);
 
                $faq=$this->_adminModel->getFaq($paged);
 
                
 
                $this->view->assign(array(
 
                'faq' => $faq,
 
                        )
 
            );
 
            }
 
            
      public function modificafaqAction(){
 
                $urlHelper = $this->_helper->getHelper('url');
 
    $this->_faq = new Application_Form_Admin_Faq();
 
    $this->_faq->setAction($urlHelper->url(array(
 
        'controller' => 'admin',
 
        'action' => 'modificafaqpost'
 
                                ),
 
        'default'
 
        ));
 
                $idfaq=$this->_getParam('idfaq',null);
 
                $questions=$this->_adminModel->getInfoFaq($idfaq)->current()->toArray();
 
               
 
    return $this->_faq->populate($questions);
 
               
 
                
 
            }
 
            
            public function modificafaqpostAction(){
 
                
 
                if (!$this->getRequest()->isPost()) {
 
                   
 
      $this->_helper->redirector('index');
 
    }
 
    $form=$this->_faq;
 
               
 
    if (!$form->isValid($_POST)) {
 
      return $this->render('modificafaq');
 
    }
 
    $values = $form->getValues();
 
    $this->_adminModel->modificafaq($values,$this->_getParam('idfaq',null));
 
    $this->_helper->redirector('visualizzafaq');
 
            }
 
            
 
            public function cancellafaqAction() {
 
                $this->_adminModel->cancellafaq($this->_getParam('idfaq',null));
 
                $this->_helper->redirector('visualizzafaq');
 
            }
 
            
               public function newfaqAction(){
 
                $urlHelper = $this->_helper->getHelper('url');
 
    $this->_newfaq = new Application_Form_Admin_Faq();
 
    $this->_newfaq->setAction($urlHelper->url(array(
 
        'controller' => 'admin',
 
        'action' => 'addfaqpost'
 
                                ),
 
        'default'
 
        ));
 
                
 
               
 
    return $this->_newfaq;
 
               
 
                
 
            }
 
            
             public function addfaqpostAction(){
 
                
 
                if (!$this->getRequest()->isPost()) {
 
                   
 
      $this->_helper->redirector('index');
 
    }
 
    $form=$this->_newfaq;
 
               
 
    if (!$form->isValid($_POST)) {
 
      return $this->render('newfaq');
 
    }
 
    $values = $form->getValues();
 
    $this->_adminModel->savefaq($values);
 
    $this->_helper->redirector('visualizzafaq');
 
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
            $idpromo = $this ->_getParam('idpromo', 0);
            
 
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