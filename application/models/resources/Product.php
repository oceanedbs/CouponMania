<?php

class Application_Resource_Product extends Zend_Db_Table_Abstract
{
    protected $_name    = 'promozione';
    protected $_primary  = 'cod_promozione';
    protected $_rowClass = 'Application_Resource_Product_Item';

	public function init()
    {
    }

	// Estrae i prodotti della categoria $categoryId, eventualmente paginati ed ordinati
    public function getProdsByCat($categoryId, $paged=null, $order=null)
    {
        $select = $this->select()
        				->where('catId IN(?)', $categoryId);
        if (true === is_array($order)) {
            $select->order($order);
        }
		if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(1)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    } 

	// Estrae i prodotti IN SCONTO della categoria $categoryId, eventualmente paginati ed ordinati
    public function getDiscProds($categoryId, $paged=null, $order=null)
    {
        $select = $this->select()
        			   ->where('catId IN(?)', $categoryId)
        			   ->where('discounted = 1');
        if (true === is_array($order)) {
            $select->order($order);
        }
		if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    } 
    
    public function insertProduct($info)
    {
    	$this->insert($info);
    }


	// Estrae tutti i prodotti
    public function getProds()
    {
        $select = $this->select();
        
        return $this->fetchAll($select);


       
    } 

}