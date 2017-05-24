<?php

class PublicController extends Zend_Controller_Action
{
	protected $_descprod = '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>';
	protected $_logger;
	
    public function init()
    {
		$this->_helper->layout->setLayout('main');
		$this->_logger = Zend_Registry::get('log');  	
    }

    public function indexAction()
    {    	    	
    	//  Categorie Top    	    	
		$topCats=array((object) array('catId'=>'1',
							 		  'name'=>'Abbigliamento',
									  'parId'=>'0',
									  'image' => "page1_img1.jpg"),
					   (object) array('catId'=>'2',
							 		  'name'=>'Articoli Sportivi',
									  'parId'=>'0',
									  'image' => "page1_img2.jpg"),
                                            (object) array('catId'=>'3',
							 		  'name'=>' Cibo',
									  'parId'=>'0',
									  'image' => "page1_img3.jpg")
					   );
					   
    	//  Sottocategorie    	    	
		$topId = $this->_getParam('selTopCat', null);
		if (!is_null($topId)) {

		// Debug
		$this->_logger->info('Attivato ' . __METHOD__ . ' - Valore di $topCats[0]->name = ' . $topCats[$topId-1]->name);

        	switch ($topId) {
            	case '1':
					$subCats=array((object) array('catId' => '4',
							 		  			  'name'=>'Laptop',
									  			  'parId'=>'1',
					   			   				  'desc'=>'Descrizione dei Prodotti Laptop'),
					   			   (object) array('catId' => '5',
							 		  			  'name'=>'NetBook',
									  			  'parId'=>'1',
					   			   				  'desc'=>'Descrizione dei Prodotti NetBook')
					   			   );
					break;
            	case '2':
					$subCats=array((object) array('catId' => '6',
							 		  			  'name'=>'HardDisk',
									  			  'parId'=>'2',
												  'desc'=>'Descrizione dei Dischi Rigidi'),
					   			   );
					break;
        	}
		} else {
			$subCats = null;
		}

		// Prodotti
		$prods=array();
		$cat = $this->_getParam('selCat', null);
		if (!is_null($cat)) {
        	switch ($cat) {
            	case '3':
					$prods=array((object) array('prodId'=>'1',
							 		  			  'name'=>'Desktop Modello1',
												  'catId'=>'3',
									  			  'descShort'=>'Caratteristiche Desktop1',
												  'descLong'=> $this->_descprod,
												  'price'=>'1230.49',
												  'discountPerc'=>'25',
												  'discounted'=>'1',
												  'image'=>'Italy.gif'),
					   			   );
					break;
            	case '4':
					$prods=array((object) array('prodId'=>'2',
							 		  			  'name'=>'Laptop Modello1',
												  'catId'=>'4',
									  			  'descShort'=>'Caratteristiche Laptop1',
												  'descLong'=> $this->_descprod,
												  'price'=>'445.37',
												  'discountPerc'=>'17',
												  'discounted'=>'0',
												  'image'=>''),
					
					   			 (object) array('prodId'=>'3',
							 		  			  'name'=>'Laptop Modello2',
												  'catId'=>'4',
									  			  'descShort'=>'Caratteristiche Laptop2',
												  'descLong'=> $this->_descprod,
												  'price'=>'1889.67',
												  'discountPerc'=>'15',
												  'discounted'=>'1',
												  'image'=>'Argentina.gif'),
					   			 );
					break;
            }
		}  
			   
    	// Definisce le variabili per il viewer
    	$this->view->assign(array(
            		'topCategories' => $topCats,
    				'selectedTopCat' => (is_null($topId) ? null : $topCats[$topId-1]->name),
    				'subCategories' => $subCats,
            		'products' => $prods
    							)
        );
    }

    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
    }
}

