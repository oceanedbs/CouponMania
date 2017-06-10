<?php

class UserController extends Zend_Controller_Action
{
        
    protected $_catalogModel;
    protected $_authService;
    protected $_publicModel;

	
	
    public function init()
    {
                $this->view->ricercareForm = $this->getRicercaForm(); 
                $this->view->stampareForm = $this->getStampareForm();
                $this->view->profiloForm = $this->getProfiloForm();
                $this->view->cambiareprofiloForm = $this->getCambiareprofiloForm();
		$this->_helper->layout->setLayout('user');
                $this->_catalogModel = new Application_Model_Catalog();
		$this->_authService = new Application_Service_Auth();
		$this->_publicModel = new Application_Model_Public();
    }



    public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
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
        $role = $this->_authService->getIdentity()->role;



        
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
                        'infoprodotto' => $infoprodotto,
                        'role'=> $role,)
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
    
    public function profiloAction(){
    
    }

    
    private function getRicercaForm() 
    { 
                $urlHelper = $this->_helper->getHelper('url'); 
    $this->_form = new Application_Form_Public_Ricercare_Ricerca(); 
        $this->_form->setAction($urlHelper->url(array( 
      'controller' => 'public', 
      'action' => 'ricercare'), 
      'default' 
    )); 
    return $this->_form; 
     
    } 
     
    public function ricercaAction () 
    {} 

    
    private function getStampareForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_User_Stampare();
    		$this->_form->setAction($urlHelper->url(array(
			'controller' => 'user',
			'action' => 'coupon'),
			'default'
		));
		return $this->_form;
    
    }
    
    public function couponAction(){
    
        $this->_helper->layout->disableLayout();
    
    }
    
    private function getProfiloForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_User_Profilo();
    		$this->_form->setAction($urlHelper->url(array(
			'controller' => 'user',
			'action' => 'cambiareprofilo'),
			'default'
		));
		return $this->_form;
    
    }
    
    public function cambiareprofiloAction() {
    
            
    
//        
    
    }
    
    private function getCambiareprofiloForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_User_Cambiareprofilo();
    		$this->_form->setAction($urlHelper->url(array(
			'controller' => 'user',
			'action' => 'cambia'),
			'default'
		));
		return $this->_form;
    
    }
    
   public function cambiaAction() {
   
      if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form;
		if (!$form->isValid($_POST)) {
			return $this->render('cambiareprofilo');
		}
		$values = $form->getValues();
		$this->_publicModel->modficaUtente($values);
		$this->_helper->redirector('index');

    }
}