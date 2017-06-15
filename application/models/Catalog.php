<?php

class Application_Model_Catalog extends App_Model_Abstract
{ 

    public function __construct()
    {
        $this->_logger = Zend_Registry::get('log');  	
    }

    public function getTopCats($paged)
    {
        return $this->getResource('Category')->getTopCats($paged);
    }
    
    public function getTopOfferte($paged)
    {
        return $this->getResource('Category')->getTopOfferte($paged);
    }
    
    public function getCatById($id)
    {
        return $this->getResource('Category')->getCatById($id);
    }

    public function getCatsByParId($parId)
    {
        return $this->getResource('Category')->getCatsByParId($parId);
    }

    
    public function getProdsByCat($catId, $paged=null, $order=null)
    {
       return $this->getResource('Promozione')->getProdsByCat($catId, $paged, $order);
    }
    
    public function getProdsByOfferte($cat, $paged=null, $order=null)
    {
        return $this->getResource('Promozione')->getProdsByOfferte($cat, $paged, $order);
    }
    
    public function getProds($paged)
    {
        return $this->getResource('Promozione')->getProds($paged);
    }
    
    public function getAziende($paged)
    {
        return $this->getResource('Aziende')->getAziende($paged);
    }
    
    public function getInfoAzienda($idazienda)
    {
        return $this->getResource('Aziende')->getInfoAzienda($idazienda);
    }
    
    public function getPromobyAzienda($idazienda)
    {
        return $this->getResource('Promozione')->getPromobyAzienda($idazienda);
    }
    
    public function getInfoprodotto($idprodotto) 
    {
        return $this->getResource('Promozione')->getInfoprodotto($idprodotto);
    }
    
    public function getRisultatiRicerca($parole, $paged)
    {
        return $this->getResource('Promozione')->getRisultatiRicerca($parole, $paged);
    }
    
    public function getRisultatiRicerca2($catId, $parole, $paged)
    {
        return $this->getResource('Promozione')->getRisultatiRicerca2($catId,$parole, $paged);
    }
    
    
}