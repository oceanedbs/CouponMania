<?php

class PublicController extends Zend_Controller_Action
{
	protected $_publicModel;
        protected $_utenteModel;
	protected $_authService;
        protected $_form1;
        protected $_form2;
        protected $_form3;
        
	
    public function init()
    {
        $this->view->ricercareForm = $this->getRicercaForm(); 
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registraForm = $this->getRegistraForm();
        $this->_helper->layout->setLayout('main');
        $this->_publicModel = new Application_Model_Public();
        $this->_utenteModel = new Application_Model_Utente();
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {    	    	
    	//  Estrae le Categorie Top    	    	
    	
        $paged = $this->_getParam('page', 1);
        
    	$topCats=$this->_publicModel->getTopCats($paged);
    	

    	
		  		   
    	// Definisce le variabili per il viewer
    	$this->view->assign(array(
            		'topCategories' => $topCats,)
        );
    }
 	
    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
    }
    
    public function prodottiAction () {
    
        $paged = $this->_getParam('page', 1);
        $cat = $this->_getParam('selTopCat', null);
        $topCats=$this->_publicModel->getTopCats($paged);
        $idprodotto = $this->_getParam('idprodotto', null);
        $infoprodotto=array();
        $prods1=array();
        $prods2=array();

        if (!is_null($cat)) {
			
			$prods1=$this->_publicModel->getProdsByCat($cat, $paged);
			$prods2= $this->_publicModel->getProdsByOfferte($cat, $paged);
         }else {
                        //estrare tutti i prodotti
                        $prods1=$this->_publicModel->getProds($paged);			   	
        }

        if (!is_null($idprodotto)) {
			
            $infoprodotto=$this->_publicModel->getInfoprodotto($idprodotto);
			
         }
    
        $topCats=$this->_publicModel->getTopCats($paged);
        
        $topOfferte=$this -> _publicModel->getTopOfferte($paged);

  
             
         $this->view->assign(array(
            		'topCategories' => $topCats,
                        'products1' => $prods1,
                        'products2'=> $prods2,
                        'topOfferte' => $topOfferte,
                        'idprodotto' => $idprodotto,
                        'infoprodotto' => $infoprodotto,)
        );
    
    	
    }
    
    public function aziendeAction () {
    
            
        $paged = $this->_getParam('page', 1);
        $idazienda = $this->_getParam('idazienda', null);
        $infoazienda='';
        $promoazienda='';

        
        $aziende=$this->_publicModel->getAziende($paged);
        
        if (!is_null($idazienda)) {
			
            $infoazienda=$this->_publicModel->getInfoAzienda($idazienda);
            $promoazienda=$this->_publicModel->getPromobyAzienda($idazienda);
			
         }
         
        $this->view->assign(array(
            		'aziende' => $aziende,
            		'idazienda' => $idazienda,
            		'infoazienda' => $infoazienda,
            		'promoazienda'=> $promoazienda,)
        );
        
        
    
    	
    }

    
    public function loginAction()
    {}

    public function authenticateAction()
	{        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $form = $this->_form1;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
        	    return $this->render('login');
        }
        
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        $role = $this->_authService->getIdentity()->role;
        return $this->_helper->redirector('index',$role);
	}
	
    private function getLoginForm()
        {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_form1 = new Application_Form_Public_Auth_Login();
    		$this->_form1->setAction($urlHelper->url(array(
			'controller' => 'public',
			'action' => 'authenticate'),
			'default'
		));
		return $this->_form1;
    } 
    
    private function getRicercaForm() 
    { 
        $urlHelper = $this->_helper->getHelper('url'); 
        $this->_form2 = new Application_Form_Public_Ricercare_Ricerca(); 
        $this->_form2->setAction($urlHelper->url(array( 
            'controller' => 'public', 
            'action' => 'risultati'), 
            'default' 
    )); 
    return $this->_form2; 
     
    } 
     
    public function ricercaAction () 
    {} 
    
    public function risultatiAction()
    {
        if (!$this->getRequest()->isPost()) {
                $this->_helper->redirector('index');
        }
        $form=$this->_form2;
        $risultati=array();
        if($form->isValid($this->getRequest()->getPost())){

           if(!$form->getValue('paroleChiave')){
                    if($form->getValue('catId') === '0')
                    {
                        $paged = $this->_getParam('page', 1);
                        $risultati=$this->_publicModel->getProds($paged);
                    }
                    else{

                        $paged = $this->_getParam('page', 1);
                        $catId = $form->getValue('catId');
                        $risultati=$this->_publicModel->getProdsByCat($catId, $paged);
                    }
            }else{
                if($form->getValue('catId')=== '0')
                    {
                        $paged = $this->_getParam('page', 1);
                        $parole = $form->getValue('paroleChiave');
                        $risultati=$this->_publicModel->getRisultatiRicerca($parole, $paged);
                    }
                else{
                
                        $paged = $this->_getParam('page', 1);
                        $parole = $form->getValue('paroleChiave');
                        $catId = $form->getValue('catId');
                        $risultati = $this->_publicModel->getRisultatiRicerca2($catId, $parole, $paged);
                    
                }
            }
        }
        
          
        $this->view->assign(array(
            		'risultati' => $risultati,)
            		);
            
    }
        
   
    

    public function registraAction()
    {}
   
     
                
       public function authenticateregAction()
	{        
        if (!$this->getRequest()->isPost()) {
                $this->_helper->redirector('index');
		}
		$form=$this->_form3;
		if (!$form->isValid($_POST)) {
			return $this->render('registra');
 		}
		$data = $form->getValues();
		$this->_utenteModel->saveUtente($data);
		$this->_helper->redirector('login', 'public');
	}
	
    private function getRegistraForm()
        {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_form3 = new Application_Form_Public_Registrare_Registra();
    		$this->_form3->setAction($urlHelper->url(array(
			'controller' => 'public',
			'action' => 'authenticatereg'),
			'default'
		));
		return $this->_form3;
        }
	
	
	 private function getStampareForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_User_Stampare();
    		$this->_form->setAction($urlHelper->url(array(
			'controller' => 'public',
			'action' => ''),
			'default'
		));
		return $this->_form;
    
    }
     public function faqAction() {
         
        $faq=$this->_publicModel->getFaq();
        
        $this->view->assign(array(
            		'faq' => $faq,)
            		);
    }
    

    
}

