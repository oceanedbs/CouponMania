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
         $date = new Zend_Db_Expr('CURDATE()');
         $select = $this->select()
                        ->from('promozione')
                       ->where('promozione.tipo_prom IN(?)', $categoryId)
                       ->join('category', 'promozione.catId = category.catId')
                        ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                        ->where('category.parId IN(?)', 1)
                        ->where('promozione.data_fine > ?', $date)
                        ->setIntegrityCheck(false);
        if (true === is_array($order)) {
            $select->order($order);
        }
		
        return $this->fetchAll($select);
    } 
    
    
    
    public function getProdsByOfferte($cat, $paged, $order){
     $date = new Zend_Db_Expr('CURDATE()');
        $select = $this->select()
                    ->from('promozione')
                     ->where('promozione.catId IN(?)', $cat)
                     ->join('category', 'promozione.catId = category.catId')
                    ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                    ->where('category.parId IN(?)', 1)
                    ->where('promozione.data_fine > ?', $date)
                    ->setIntegrityCheck(false);
        if (true === is_array($order)) {
            $select->order($order);
        }
		
        return $this->fetchAll($select);
    }

    
    public function insertProduct($info)
    {
        $date = new Zend_Db_Expr('CURDATE()');
        if(($info->data_inizio >= $date) & ($info->data_fine > $info->data_inizio)) {
    
            $this->insert($info);
        }
        else {
            return 1;
            }
    }


	// Estrae tutti i prodotti
    public function getProds($paged)
    {
     $date = new Zend_Db_Expr('CURDATE()');
        $select = $this->select()
                        ->from('promozione')
                        ->join('category', 'promozione.tipo_prom = category.catId')
                        ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                        ->where('promozione.data_fine > ?', $date)
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
    
    public function getProdsStaff($paged,$idstaff, $order)
    {
        $select = $this->select()
                        ->from('promozione')
                        ->join('category', 'promozione.tipo_prom = category.catId')
                        ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                        ->join('permessi', 'permessi.P_Iva=aziende.P_Iva')
                        ->where('permessi.ID_utente = ?', $idstaff)
                        ->order("data_fine")
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
     $date = new Zend_Db_Expr('CURDATE()');
        $select = $this->select()
                        ->from('promozione')
                        ->where('promozione.P_Iva IN(?)', $idazienda)
                        ->join('category', 'promozione.catId = category.catId')
                        ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                        ->where('category.parId IN(?)', 1)
                        ->where('promozione.data_fine > ?', $date)
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
    
        $date = new Zend_Db_Expr('CURDATE()');

        $select=$this->select()
                    ->from('promozione')
                    ->where('promozione.prodotto IN(?)',$parole)
 
                    ->orWhere('promozione.descrizione_prom LIKE ?', "%$parole%")
                    ->join('category', 'promozione.catId = category.catId')
                    ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                    ->where('category.parId IN(?)', 1)
                    ->where('promozione.data_fine > ?', $date)
                    ->setIntegrityCheck(false);
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
        
        $date = new Zend_Db_Expr('CURDATE()');

    
        $select=$this->select()
                    ->from('promozione')
                    ->where('promozione.prodotto IN(?)',$parole)
                    ->orWhere('promozione.descrizione_prom LIKE ?', "%$parole%")
                    ->where('promozione.tipo_prom IN(?)', $catId)
                    ->join('category', 'promozione.catId = category.catId')
                    ->join('aziende', 'promozione.P_Iva = aziende.P_Iva')
                    ->where('category.parId IN(?)', 1)
                    ->where('promozione.data_fine > ?', $date)
                    ->setIntegrityCheck(false);
                   
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