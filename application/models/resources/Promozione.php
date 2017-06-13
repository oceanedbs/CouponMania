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
                       ->where('tipo_prom IN(?)', $categoryId);
        if (true === is_array($order)) {
            $select->order($order);
        }
		
        return $this->fetchAll($select);
    } 
    
    public function getProdsByOfferte($cat, $paged, $order){
        $select = $this->select()
                     ->where('catId IN(?)', $cat);
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
        $select = $this->select();
        
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
                        ->where('P_Iva IN(?)', $idazienda);
        return $this->fetchAll($select);
    }
    
    public function getInfoprodotto($idprodotto)
    {
        // metodo find esegue una select * where $primary = parametro passato
        return $this->find($idprodotto);

    
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