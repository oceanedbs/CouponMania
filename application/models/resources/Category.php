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
    public function getTopCats()
    {
		$select = $this->select()
					   ->where('parId = 0')
                       ->order('name');
        return $this->fetchAll($select);
    }

	// Estrae tutte le Sottocategorie
    public function getSubCats()
    {
		$select = $this->select()
					   ->where('parId != 0')
                       ->order('name');
        return $this->fetchAll($select);
    }
    
	// Estrae le categorie figlie dirette ($deep===false) o discendenti ($deep===true) di $catId
    public function getCatChilIds($catId, $deep = false)
    {    	
    	$categories = $this->getCatsByParId($catId);
    	$cats = array();
    	
        foreach ($categories as $cat) {
            $cats[] = $cat->catId;
            if (true === $deep) {
                $cats = array_merge($cats, $this->getCatChilIds($cat->catId, true));
            }
        }
        return $cats;
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

