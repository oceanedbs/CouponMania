<?php

class PublicController extends Zend_Controller_Action
{
	protected $_catalogModel;
	protected $_authService;
	
    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_authService = new Application_Service_Auth();
        $this->view->loginForm = $this->getLoginForm();
    }

    public function indexAction()
    {    	    	
    	//  Estrae le Categorie Top    	    	
    	
        $paged = $this->_getParam('page', 1);
    	$topCats=$this->_catalogModel->getTopCats($paged);
    	

    	
		  		   
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
        $topCats=$this->_catalogModel->getTopCats($paged);
        $idprodotto = $this->_getParam('idprodotto', null);
        $infoprodotto='';


        
        if (!is_null($cat)) {
			
			$prods=$this->_catalogModel->getProdsByCat($cat, $paged);
		
         }else {
			
		//	Nessuna selezione: estrae tutti i prodotti in sconto
			foreach ($topCats as $topCat) {
				$topCatsList[] = $topCat->catId;
                        }
                        $prods=$this->_catalogModel->getProds($topCatsList, $paged);			   	
        }

        if (!is_null($idprodotto)) {
			
            $infoprodotto=$this->_catalogModel->getInfoprodotto($idprodotto);
			
         }
    
        $topCats=$this->_catalogModel->getTopCats($paged);
        
        $topOfferte=$this -> _catalogModel->getTopOfferte($paged);

  
             
         $this->view->assign(array(
            		'topCategories' => $topCats,
                        'products' => $prods,
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

        
        $aziende=$this->_catalogModel->getAziende($paged);
        
        if (!is_null($idazienda)) {
			
            $infoazienda=$this->_catalogModel->getInfoAzienda($idazienda);
            $promoazienda=$this->_catalogModel->getPromobyAzienda($idazienda);
			
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
        $form = $this->_form;
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
		$this->_form = new Application_Form_Public_Auth_Login();
    		$this->_form->setAction($urlHelper->url(array(
			'controller' => 'public',
			'action' => 'authenticate'),
			'default'
		));
		return $this->_form;
    }   	
    


    public function registraAction()
    {}
   
     private function getRegistraForm()
        {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Public_Registra();
    		$this->_form->setAction($urlHelper->url(array(
			'controller' => 'public',
			'action' => 'authenticatereg'),
			'default'
		));
		return $this->_form;
        }
                
       public function authenticateregAction()
	{        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('registra');
        }
        $form = $this->_form;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
        	    return $this->render('registra');
        }
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Registrazione fallita. Riprova');
            return $this->render('registra');
        }
        $role = $this->_authService->getIdentity()->role;
        return $this->_helper->redirector('index',$role );
	}          
    
}

