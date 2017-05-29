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
    	$topCats=$this->_catalogModel->getTopCats();

    	
		  		   
    	// Definisce le variabili per il viewer
    	$this->view->assign(array(
            		'topCategories' => $topCats,
            		'products' => $prods
            		)
        );
    }
 	
    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
    }
    
    public function prodottiAction () {
    
        $topCats=$this->_catalogModel->getTopCats();
        
       // $paged = $this->_getParam('page', 1);
        
      $prods=$this->_catalogModel->getProds();


  
            
        $this->view->assign(array(
            		'topCategories' => $topCats,
                        'products' => $prods,)
        );
    
    	
    }
    
     public function aziendeAction () {
    
        
       // $paged = $this->_getParam('page', 1);
        
      $aziende=$this->_catalogModel->getAziende();


  
                                        
        $this->view->assign(array(
            		'aziende' => $aziende,)
        );
    
    	
    }
    
}

