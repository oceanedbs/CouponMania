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
}

