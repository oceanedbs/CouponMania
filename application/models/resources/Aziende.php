<?php

class Application_Resource_Aziende extends Zend_Db_Table_Abstract
{
    protected $_name    = 'aziende';
    protected $_primary  = 'P_Iva';
    protected $_rowClass = 'Application_Resource_Aziende_Item';
    
    public function init()
    {
    }
    
    public function getAziende() {
        $select = $this->select()
                       ->order('nome');
        return $this->fetchAll($select);
    
    }
    
}
 
