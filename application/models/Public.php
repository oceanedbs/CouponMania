<?php

class Application_Model_Public extends App_Model_Abstract
{ 

	public function __construct()
    {
    }

    public function getSubCats()
    {
        return $this->getResource('Category')->getSubCats();
    }
    
    public function saveProduct($info)
    {
    	return $this->getResource('Product')->insertProduct($info);
    }
}