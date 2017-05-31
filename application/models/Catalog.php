<?php

class Application_Model_Catalog extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}

    public function getTopCats()
    {
		return $this->getResource('Category')->getTopCats();
    }
    public function getCatById($id)
    {
        return $this->getResource('Category')->getCatById($id);
    }

    public function getCatsByParId($parId)
    {
        return $this->getResource('Category')->getCatsByParId($parId);
    }
       
    public function getDiscProds($catId, $paged=null, $order=null, $deep=true)
    {
        if (true === $deep) {
            $ids = $this->getResource('Category')->getCatChilIds($catId, true);                       
            $ids[] = $catId;
			$catId = $ids;
        }       
    		return $this->getResource('Product')->getDiscProds($catId, $paged, $order);
    }    
    
    public function getProdsByCat($catId, $paged=null, $order=null, $deep=true)
    {
        if (true === $deep) {
            $ids = $this->getResource('Category')->getCatChilIds($catId, true);                       
            $ids[] = $catId;
			$catId = $ids;
        }       
        return $this->getResource('Product')->getProdsByCat($catId, $paged, $order);
    }
}