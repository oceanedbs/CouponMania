<?php

class Application_Resource_Category extends Zend_Db_Table_Abstract
{
    protected $_name    = 'category';
    protected $_primary  = 'catId';
    protected $_rowClass = 'Application_Resource_Category_Item';
    
	public function init()
    {
    }

	// Estrae i dati della categoria $id
    public function getCatById($id)
    {
        return $this->find($id)->current();
    }
    
	// Estrae tutte le categorie Top
    public function getTopCats($paged)
    
    {
		$select = $this->select()
                                -> where('parId = 0');
  
  
            return $this->fetchAll($select);
    }
    
    public function getTopOfferte($paged)
    
    {
		$select = $this->select()
                                -> where('parId = 1');
  
		
            return $this->fetchAll($select);
    }

	// Estrae le categorie figlie dirette di $parId    
    public function getCatsByParId($parId)
    {
        $select = $this->select()
                        ->where('parId IN(?)', $parId)
                        ->order('name');
        return $this->fetchAll($select);
    }    
    
     public function getCategory($paged) {
        $select = $this->select()
                       ->order('catId');
                       
        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(10)
                        ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
    }
    
     public function getInfoCategory($idcategory){
    
        return $this->find($idcategory);
     }
     
     public function insertCategory($info)
    {
    	$this->insert($info);
    }
    
    public function modificaCategory($values,$idcat)
    {
        $where="catId = $idcat";
        $this->update($values,$where);
    }
    
     public function cancellaCategory($idcategory)
    {
        $where="catId = $idcategory";
        $this->delete($where);
        
    }
}

