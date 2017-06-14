<?php

class Application_Model_Admin extends App_Model_Abstract
{ 

    public function __construct()
    {
    }

    public function getSubCats()
    {
        return $this->getResource('Category')->getSubCats();
    }
    
    public function saveStaff($info)
    {
    	return $this->getResource('Utente')->insertStaff($info);
    }
    
    public function saveAziende($info)
    {
    	return $this->getResource('Aziende')->insertAziende($info);
    }
   
    public function getUserByName($info)
    {
    	return $this->getResource('Utente')->getUserByName($info);
    }
    
    public function getUtentiById($paged)
    {
       return $this->getResource('Utente')->getUtentiById($paged);
    } 
    
    public function getInfoUtente(){
        return $this->getResource('Utente')->getInfoUtente();
    }
    
    public function getInfoUtente2($idutente){
        return $this->getResource('Utente')->getInfoUtente2($idutente);
    }
    
    public function modificaUtente2($values,$idutente)
    {
        return $this->getResource('Utente')->modificaUtente2($values,$idutente);
    }
    
   public function cancellaUtente($utente)
    {
        return $this->getResource('Utente')->cancellaUtente($utente);

    }
    
    public function getAziende($paged)
    {
       return $this->getResource('Aziende')->getAziende($paged);
       
    }
    
    public function getInfoAzienda($idazienda){
        return $this->getResource('Aziende')->getInfoAzienda($idazienda);
    }
    
    public function modificaAziende($values,$idazi)
    {
        return $this->getResource('Aziende')->modificaAziende($values,$idazi);
    }
    
     public function cancellaAzienda($idazienda)
    {
        return $this->getResource('Aziende')->cancellaAzienda($idazienda);

    }
    
   public function getCategory($paged)
    {
       return $this->getResource('Category')->getCategory($paged);
       
    }
    
    public function saveCategory($info)
    {
    	return $this->getResource('Category')->insertCategory($info);
    }
    
     public function modificaCategory($values,$idcat)
    {
        return $this->getResource('Category')->modificaCategory($values,$idcat);
    }
    
    public function getInfoCategory($idcategory){
        return $this->getResource('Category')->getInfoCategory($idcategory);
    }
    
    public function cancellaCategory($idcategory)
    {
        return $this->getResource('Category')->cancellaCategory($idcategory);

    }
    
    public function numeroCoupon()
    {
        return $this->getResource('Coupon')->numeroCoupon();
    }

    public function numeroUtenti()
    {
        return $this->getResource('Utente')->numeroUtenti();
    }
    public function numeroAziende()
    {
        return $this->getResource('Aziende')->numeroAziende();
    }
    public function getUtente()
    {
        return $this->getResource('Utente')->getUtente();
    }
    
    public function getCouponUtente($idutente)
    {
        return $this->getResource('Coupon')->getCouponUtente($idutente);
    }
     public function getProds($paged)
    {
        return $this->getResource('Promozione')->getProds($paged);
    }
    
    public function getCouponPromo($idpromo)
    {
        return $this->getResource('Coupon')->getCouponPromo($idpromo);
    }
    
    public function modificafaq($values,$idfaq){
       return $this->getResource('Faq')->modificafaq($values,$idfaq); 
    }
    
    public function getFaq()
    {
        return $this->getResource('Faq')->getFaq();
    }
    
    public function getInfofaq($idfaq)
    {
        return $this->getResource('Faq')->getInfoFaq($idfaq);
    }
    
    public function cancellafaq($idfaq) {
        return $this->getResource('Faq')->cancellafaq($idfaq);
    }
    
    public function savefaq($values) {
        return $this->getResource('Faq')->insertfaq($values);
    }
    
}
