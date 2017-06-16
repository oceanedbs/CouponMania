<?php

class UserController extends Zend_Controller_Action
{
    protected $_authService;
    protected $_utenteModel;
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
		$this->_utenteModel = new Application_Model_Utente();
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
    	$topCats=$this->_utenteModel->getTopCats($paged);
    	
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
        $topCats=$this->_utenteModel->getTopCats($paged);
        $idprodotto = $this->_getParam('idprodotto', null);
        $infoprodotto=array();
        $prods1=array();
        $prods2=array();

        if (!is_null($cat)) {
			
			$prods1=$this->_utenteModel->getProdsByCat($cat, $paged);
			$prods2= $this->_utenteModel->getProdsByOfferte($cat, $paged);
         }else {
                        //estrare tutti i prodotti
                        $prods1=$this->_utenteModel->getProds($paged);			   	
        }

        if (!is_null($idprodotto)) {
			
            $infoprodotto=$this->_utenteModel->getInfoprodotto($idprodotto);
			
         }
    
        $topCats=$this->_utenteModel->getTopCats($paged);
        
        $topOfferte=$this -> _utenteModel->getTopOfferte($paged);

  
             
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

        
        $aziende=$this->_utenteModel->getAziende($paged);
        
        if (!is_null($idazienda)) {
			
            $infoazienda=$this->_utenteModel->getInfoAzienda($idazienda);
            $promoazienda=$this->_utenteModel->getPromobyAzienda($idazienda);
			
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

           if(!$form->getValue('paroleChiave')){
                    if($form->getValue('catId') === '0')
                    {
                        $paged = $this->_getParam('page', 1);
                        $risultati=$this->_utenteModel->getProds($paged);
                    }
                    else{

                        $paged = $this->_getParam('page', 1);
                        $catId = $form->getValue('catId');
                        $risultati=$this->_utenteModel->getProdsByCat($catId, $paged);
                    }
            }else{
                if($form->getValue('catId')=== '0')
                    {
                        $paged = $this->_getParam('page', 1);
                        $parole = $form->getValue('paroleChiave');
                        $risultati=$this->_utenteModel->getRisultatiRicerca($parole, $paged);
                    }
                else{
                
                        $paged = $this->_getParam('page', 1);
                        $parole = $form->getValue('paroleChiave');
                        $catId = $form->getValue('catId');
                        $risultati = $this->_utenteModel->getRisultatiRicerca2($catId, $parole, $paged);
                    
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
        $messagio=0;
        
        $infoprodotto=$this->_utenteModel->getInfoprodotto($idprodotto);
        
        $data = array( 'cod_promozione' => $idprodotto ,
                      'ID_utente' =>$iduser  );
                      
        $verificare= $this->_utenteModel->verificareCoupon($idprodotto, $iduser);
                      
        if( $verificare == 0)
        {
            $messagio=1;
        }
        else 
        {
            $this->_utenteModel->registraCoupon($data);
        }

        
        $this->view->assign(array(
                        'infoprodotto' => $infoprodotto,
                        'idprodotto' =>$idprodotto,
                        'messagio' => $messagio,
                        'verificare' => $verificare,)
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
       $dataInizio = $values['data_nascita'];
       $giorno = substr($dataInizio, 0, 2);
       $mese = substr($dataInizio, 3, 2);
       $anno = substr($dataInizio, 6, 4);
       $values['data_nascita'] = "$anno-$mese-$giorno";
		$this->_utenteModel->modficaUtente($values);
		$this->_helper->redirector('index');

    }
    
    public function faqAction(){
       
     $faq=$this->_utenteModel->getFaq(); 
     $this->view->assign(array(
            		'faq' => $faq,));
    }
}