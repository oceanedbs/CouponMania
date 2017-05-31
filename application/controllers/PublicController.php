<?php

class PublicController extends Zend_Controller_Action
{
	protected $_catalogModel;
	
    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_catalogModel = new Application_Model_Catalog();
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

        
        if (!is_null($cat)) {
			
			$prods=$this->_catalogModel->getProdsByCat($cat, $paged);
		
         }else {
			
		//	Nessuna selezione: estrae tutti i prodotti in sconto
			foreach ($topCats as $topCat) {
				$topCatsList[] = $topCat->catId;
                        }
                        $prods=$this->_catalogModel->getProds($topCatsList, $paged);			   	
        }

    
        $topCats=$this->_catalogModel->getTopCats($paged);
        
        $topOfferte=$this -> _catalogModel->getTopOfferte($paged);

  
             
         $this->view->assign(array(
            		'topCategories' => $topCats,
                        'products' => $prods,
                        'topOfferte' => $topOfferte,)
        );
    
    	
    }
    
    public function aziendeAction () {
    
        
        $paged = $this->_getParam('page', 1);
        
        $aziende=$this->_catalogModel->getAziende($paged);

                                        
        $this->view->assign(array(
            		'aziende' => $aziende,)
        );
    
    	
    }
    
    public function infoaziendaAction ()  {
    }
    
}

