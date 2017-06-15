<?php

class Application_Model_Utente extends App_Model_Abstract
{ 

	public function __construct()
    {
    }

    public function getTopCats($paged)
    {
        return $this->getResource('Category')->getTopCats($paged);
    }
    
    public function getTopOfferte($paged)
    {
        return $this->getResource('Category')->getTopOfferte($paged);
    }
    
     public function getInfoprodotto($idprodotto) 
    {
        return $this->getResource('Promozione')->getInfoprodotto($idprodotto);
    }
    
    public function getProds($paged)
    {
        return $this->getResource('Promozione')->getProds($paged);
    }
    
    public function getAziende($paged)
    {
        return $this->getResource('Aziende')->getAziende($paged);
    }
    
     public function getProdsByCat($catId, $paged=null, $order=null)
    {
       return $this->getResource('Promozione')->getProdsByCat($catId, $paged, $order);
    }
    
    public function getProdsByOfferte($cat, $paged=null, $order=null)
    {
        return $this->getResource('Promozione')->getProdsByOfferte($cat, $paged, $order);
    }
    
    public function getInfoAzienda($idazienda)
    {
        return $this->getResource('Aziende')->getInfoAzienda($idazienda);
    }
    
    public function getPromobyAzienda($idazienda)
    {
        return $this->getResource('Promozione')->getPromobyAzienda($idazienda);
    }
    
    public function saveProduct($info)
    {
    	return $this->getResource('Promozione')->insertProduct($info);
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
    
     public function getRisultatiRicerca($parole, $paged)
    {
        return $this->getResource('Promozione')->getRisultatiRicerca($parole, $paged);
    }
    
    public function getRisultatiRicerca2($catId, $parole, $paged)
    {
        return $this->getResource('Promozione')->getRisultatiRicerca2($catId,$parole, $paged);
    }
    
    public function verificareCoupon($idprodotto, $idutente)
    {
        return $this->getResource('Coupon')->verificareCoupon($idprodotto, $idutente);
    }
    
     public function getFaq()
    {
        return $this->getResource('Faq')->getFaq();
    }
    
}