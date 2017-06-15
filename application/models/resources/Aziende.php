<?php

class Application_Resource_Aziende extends Zend_Db_Table_Abstract
{
    protected $_name    = 'aziende';
    protected $_primary  = 'P_Iva';
    protected $_rowClass = 'Application_Resource_Aziende_Item';
    
    public function init()
    {
    }
    
    public function getAziende($paged) {
        $select = $this->select()
                       ->order('nome');
                       
         if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(3)
                        ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
    }
        
    public function getInfoAzienda($idazienda){
    
        return $this->find($idazienda);
     }
    
    public function insertAziende($info)
    {
    	$this->insert($info);
    }
    
     public function modificaAziende($values,$idazienda)
    {
        $where="P_Iva = $idazienda";
        $this->update($values,$where);
    }
     public function numeroAziende()
    {
        $rowset   = $this->fetchAll();
 
        $rowCount = count($rowset);
                                
        return  $rowCount;
    }
    
     public function cancellaAzienda($idazienda)
    {
        $where="P_Iva = $idazienda";
        $this->delete($where);
        
    }
    
    
}
 
