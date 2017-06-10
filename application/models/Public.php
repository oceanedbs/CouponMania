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
    
    public function saveUtente($info)
    {
    	return $this->getResource('Utente')->insertUtente($info);
    }
     public function getInfoUtente()
    {
    	return $this->getResource('Utente')->getInfoUtente();
    }
    public function modficaUtente($values)
    {
        return $this->getResource('Utente')->modificaUtente($values);
    }
    public function registraCoupon($data)
    {
        return $this->getResource('Coupon')->registraCoupon($data);
    }
}