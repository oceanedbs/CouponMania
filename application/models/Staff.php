<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

	public function __construct()
    {
    }

    public function getTopOfferte($paged)
    {
                return $this->getResource('Category')->getTopOfferte($paged);

    }
    
     public function getTopCats($paged)
    {
		return $this->getResource('Category')->getTopCats($paged);
    }
    public function getProds($paged)
    {
       return $this->getResource('Promozione')->getProds($paged);
       
    } 
    public function getInfoprodotto($idprodotto){
        return $this->getResource('Promozione')->getInfoprodotto($idprodotto);
    }
    
    public function saveProduct($info)
    {
    	return $this->getResource('Promozione')->insertProduct($info);
    }
    
    public function getAziende($paged)
    {
        return $this->getResource('Aziende')->getAziende($paged);
    }
    public function modificaPromo($values,$idpromo)
    {
        return $this->getResource('Promozione')->modificaPromo($values,$idpromo);
    }
    
    public function cancellaPromo ($idpromo)
    {
        return $this->getResource('Promozione')->cancellaPromo($idpromo);
        
    }
}