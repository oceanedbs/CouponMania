<?php

class UserController extends Zend_Controller_Action
{
    protected $_authService;
    protected $_publicModel;
    protected $_form1;
    protected $_form2;
    protected $_form3;
    protected $_form4;

	
	
    public function init()
    {
                $this->view->ricercareForm = $this->getRicercaForm(); 
                $this->view->stampareForm = $this->getStampareForm();
                $this->view->profiloForm = $this->getProfiloForm();
                $this->view->cambiareprofiloForm = $this->getCambiareprofiloForm();
		$this->_helper->layout->setLayout('user');
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
    
    public function profiloAction(){
    
    }
    
    private function getRicercaForm() 
    { 
        $urlHelper = $this->_helper->getHelper('url'); 
        $this->_form1 = new Application_Form_User_Ricerca(); 
        $this->_form1->setAction($urlHelper->url(array( 
            'controller' => 'user', 
            'action' => 'risultati'), 
            'default' 
    )); 
    return $this->_form1; 
     
    } 
     
    public function ricercaAction () 
    {} 
    
    public function risultatiAction()
    {
        if (!$this->getRequest()->isPost()) {
                $this->_helper->redirector('index');
        }
        $form=$this->_form1;
        $risultati=array();
        if($form->isValid($this->getRequest()->getPost())){

           if(empty($form->getValue('paroleChiave'))){
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

    
    private function getStampareForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form2 = new Application_Form_User_Stampare();
    		$this->_form2->setAction($urlHelper->url(array(
			'controller' => 'user',
			'action' => 'coupon'),
			'default'
		));
		return $this->_form2;
    
    }
    
    public function couponAction(){
    
        $this->_helper->layout->disableLayout();
        
        $idprodotto = $this->_getParam('idprodotto', null);
        $iduser= $this->_authService->getIdentity()->ID_utente;

        
        $infoprodotto=$this->_publicModel->getInfoprodotto($idprodotto);
        
        $data = array( 'cod_promozione' => $idprodotto ,
                      'ID_utente' =>$iduser  );

        $this->_publicModel->registraCoupon($data);

        
        $this->view->assign(array(
                        'infoprodotto' => $infoprodotto,
                        'idprodotto' =>$idprodotto,)
        );
        

        
    
    }
    
    private function getProfiloForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form3 = new Application_Form_User_Profilo();
    		$this->_form3->setAction($urlHelper->url(array(
			'controller' => 'user',
			'action' => 'cambiareprofilo'),
			'default'
		));
		return $this->_form3;
    
    }
    
    public function cambiareprofiloAction() {
    
    }
    
    private function getCambiareprofiloForm(){
    
                $urlHelper = $this->_helper->getHelper('url');
		$this->_form4 = new Application_Form_User_Cambiareprofilo();
    		$this->_form4->setAction($urlHelper->url(array(
			'controller' => 'user',
			'action' => 'cambia'),
			'default'
		));
		return $this->_form4;
    
    }
    
   public function cambiaAction() {
   
      if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form4;
		if (!$form->isValid($_POST)) {
			return $this->render('cambiareprofilo');
		}
		$values = $form->getValues();
		$this->_publicModel->modficaUtente($values);
		$this->_helper->redirector('index');

    }
}