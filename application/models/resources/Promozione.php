<?php

class Application_Resource_Promozione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'promozione';
    protected $_primary  = 'cod_promozione';
    protected $_rowClass = 'Application_Resource_Promozione_Item';

	public function init()
    {
    }

	// Estrae i prodotti della categoria $categoryId, eventualmente paginati ed ordinati
   public function getProdsByCat($categoryId, $paged=null, $order=null)
    {
         $select = $this->select()
                        ->from('promozione')
                       ->where('promozione.tipo_prom IN(?)', $categoryId)
                       ->join('category', 'promozione.catId = category.catId')
                        ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                        ->where('category.parId IN(?)', 1)
                        ->setIntegrityCheck(false);
        if (true === is_array($order)) {
            $select->order($order);
        }
		
        return $this->fetchAll($select);
    } 
    
    public function getProdsByOfferte($cat, $paged, $order){
        $select = $this->select()
                    ->from('promozione')
                     ->where('promozione.catId IN(?)', $cat)
                     ->join('category', 'promozione.catId = category.catId')
                    ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                    ->where('category.parId IN(?)', 1)
                    ->setIntegrityCheck(false);
        if (true === is_array($order)) {
            $select->order($order);
        }
		
        return $this->fetchAll($select);
    }

    
    public function insertProduct($info)
    {
    	$this->insert($info);
    }


	// Estrae tutti i prodotti
    public function getProds($paged)
    {
        $select = $this->select()
                        ->from('promozione')
                        ->join('category', 'promozione.tipo_prom = category.catId')
                        ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                        ->setIntegrityCheck(false);
        
        if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(6)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
        }
        
        return $this->fetchAll($select);
       
    } 
    
    public function getPromobyAzienda($idazienda)
    {
        $select = $this->select()
                        ->from('promozione')
                        ->where('promozione.P_Iva IN(?)', $idazienda)
                        ->join('category', 'promozione.catId = category.catId')
                        ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                        ->where('category.parId IN(?)', 1)
                        ->setIntegrityCheck(false);
        return $this->fetchAll($select);
    }
     public function getInfoprodotto($idprodotto)
    {
         $select = $this->select()
                    ->from('promozione')
                    ->where('promozione.cod_promozione IN (?)', $idprodotto)
                    ->join('category', 'promozione.catId = category.catId')
                    ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                    ->where('category.parId IN(?)', 1)
                    ->setIntegrityCheck(false);
                    
                
    return $this->fetchAll($select);

    
    }

    public function modificaPromo($values,$idprodotto)
    {
        $where="cod_promozione = $idprodotto";
        $this->update($values,$where);
    }
    
    public function cancellaPromo($idprodotto)
    {
        $where="cod_promozione = $idprodotto";
        $this->delete($where);
        
    }
        

    
    public function  getRisultatiRicerca($parole, $paged)
    {
    
        $select=$this->select()
                    ->where('prodotto IN(?)',$parole)
                    ->orWhere('descrizione LIKE ?', "%$parole%");
        return $this->fetchAll($select);
        
         if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(6)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
        }
    }
    
     public function  getRisultatiRicerca2($catId, $parole, $paged)
    {
    
        $select=$this->select()
                    ->where('prodotto IN(?)',$parole)
                    ->orWhere('descrizione LIKE ?', "%$parole%")
                    ->where('tipo_prom IN(?)', $catId);
        return $this->fetchAll($select);
        
         if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(6)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
        }

    }
    
   

}