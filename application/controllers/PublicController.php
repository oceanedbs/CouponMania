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
							 		  'name'=>'sull\'Abbigliamento',
									  'parId'=>'0',
                                                                          'logo' =>'icon1.png',                                                                             
									  'image' => 'page1_img1.jpg',),
                                (object) array('catId'=>'2',
							 		  'name'=>'su Articoli Sportivi',
									  'parId'=>'0',
                                                                           'logo' =>'icon2.png',                                                     
									  'image' =>'page1_img2.jpg'),
                                (object) array('catId'=>'3',
							 		  'name'=>' sugli Alimenti <br> ',
									  'parId'=>'0',
									  'logo' =>'icon3.png',
									  'image' => 'page1_img3.jpg')
					   );
					   
			   
    	// Definisce le variabili per il viewer
    	$this->view->assign(array(
            		'topCategories' => $topCats,
    							)
        );
    }

    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
    }
    
    public function prodottiAction () {
    
    $topCats=array((object) array('catId'=>'1',
							 		  'name'=>'Abbigliamento',
									  'parId'=>'0',
									  'image' => 'page1_img1.jpg',),
                                (object) array('catId'=>'2',
							 		  'name'=>'Articoli Sportivi',
									  'parId'=>'0',
									  'image' =>'page1_img2.jpg'),
                                (object) array('catId'=>'3',
							 		  'name'=>' Cibo',
									  'parId'=>'0',
									  'image' => 'page1_img3.jpg')
					   );
					   
    $prods=array((object) array('prodId'=>'1',
                                'name'=>'Desktop Modello1',
                                'catId'=>'1',
                                'descShort'=>'Caratteristiche Desktop1',
                                'descLong'=> $this->_descprod,
                                'price'=>'1230.49',
                                'discountPerc'=>'25',
                                'discounted'=>'1',
                                'image'=>'page1_img4.jpg'),
                                
                (object) array('prodId'=>'2',
                                'name'=>'Laptop Modello1',
                                'catId'=>'1',
                                'descShort'=>'Caratteristiche Laptop1',
                                'descLong'=> $this->_descprod,
                                'price'=>'445.37',
                                'discountPerc'=>'17',
                                'discounted'=>'0',
                                'image'=>'page1_img5.jpg'),
					
                (object) array('prodId'=>'3',
                                'name'=>'Laptop Modello2',
                                'catId'=>'1',
                                'descShort'=>'Caratteristiche Laptop2',
                                'descLong'=> $this->_descprod,
                                'price'=>'1889.67',
                                'discountPerc'=>'15',
                                'discounted'=>'1',
                                'image'=>'page1_img6.jpg'),
                                                        );
								
                                                                    
  
					   
					   
    $this->view->assign(array(
            		'topCategories' => $topCats,
                        'products' => $prods,)
        );
    
    	
    }
    public function offerteAction () {
    
      $offerte=array((object) array('catId'=>'1',
							 		  'name'=>'3x1',
									  'parId'=>'0',),
                     (object) array('catId'=>'2',
							 		  'name'=>'2x1',
									  'parId'=>'0',),
                     (object) array('catId'=>'3',
							 		  'name'=>' -50%',
									  'parId'=>'0',)
					   );
					   
         $prods=array((object) array('prodId'=>'1',
                                'name'=>'Desktop Modello1',
                                'catId'=>'1',
                                'descShort'=>'Caratteristiche Desktop1',
                                'descLong'=> $this->_descprod,
                                'price'=>'1230.49',
                                'discountPerc'=>'25',
                                'discounted'=>'1',
                                'image'=>'page1_img4.jpg'),
                                
                (object) array('prodId'=>'2',
                                'name'=>'Laptop Modello1',
                                'catId'=>'1',
                                'descShort'=>'Caratteristiche Laptop1',
                                'descLong'=> $this->_descprod,
                                'price'=>'445.37',
                                'discountPerc'=>'17',
                                'discounted'=>'0',
                                'image'=>'page1_img5.jpg'),
					
                (object) array('prodId'=>'3',
                                'name'=>'Laptop Modello2',
                                'catId'=>'1',
                                'descShort'=>'Caratteristiche Laptop2',
                                'descLong'=> $this->_descprod,
                                'price'=>'1889.67',
                                'discountPerc'=>'15',
                                'discounted'=>'1',
                                'image'=>'page1_img6.jpg'),
                                                        );
								
					   
     $this->view->assign(array(
                        'offerte' => $offerte,
                        'products' => $prods,)
        );
    
    }
    
        public function aziendeAction () {
        
        $aziende=array((object) array('catId'=>'1',
							 		  'name'=>'Decathlon',
									  'parId'=>'0',
									   'image'=>'decathlon.jpg'),
                     (object) array('catId'=>'2',
							 		  'name'=>'Auchan',
									  'parId'=>'0',
									   'image'=>'auchan.jpg',),
                     (object) array('catId'=>'3',
							 		  'name'=>' Coop',
									  'parId'=>'0',
                                                                           'image'=>'coop.jpg',),
					   );

      $this->view->assign(array(
                        'aziende' => $aziende,)
                         );
                         
                          }
}


