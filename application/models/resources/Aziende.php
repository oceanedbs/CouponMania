<?php

class Application_Resource_Azienda extends Zend_Db_Table_Abstract
{
    protected $_name    = 'aziende';
    protected $_primary  = 'P_Iva';
    protected $_rowClass = 'Application_Resource_Azienda_Item';
    
    public function init()
    {
    }
    
    public function getAziende() {
        $select = $this->select()
                       ->order('name');
        return $this->fetchAll($select);
    
    }
    
}
 
