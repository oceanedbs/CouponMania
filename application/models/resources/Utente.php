<?php

class Application_Resource_Utente extends Zend_Db_Table_Abstract
{
    protected $_name    = 'utente';
    protected $_primary  = 'ID_utente';
    protected $_rowClass = 'Application_Resource_Utente_Item';
    protected $_authService;


	
	public function init()
    {
        $this->_authService = new Application_Service_Auth();

    }
       
    public function getUserByName($usrName)
    {
        return $this->fetchRow($this->select()->where('username = ?', $usrName));
    }
    
     
     public function getUtentiById($paged) {
        $select = $this->select()
                       // ->where('role IN(?)', 'staff')
                        //->where('role IN(?)', 'user');
                       ->order('role');
                       
        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(10)
                        ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
    }
    
    public function insertUtente($info)
    {
    	$this->insert($info);
    }
    
    public function insertStaff($info)
    {
    	$this->insert($info);
    }
    
    public function getInfoUtente(){
    
        $username=$this->_authService->getIdentity()->username;
        return $this->fetchRow($this->select()->where('username= ?', $username));
     }
     
      public function getInfoUtente2($idutente){
    
        return $this->find($idutente);
     }
    
    public function modificaUtente2($values,$idutente)
    {
        $where="ID_utente = $idutente";
        $this->update($values,$where);
    }
    
     public function modificaUtente($values)
 
    {
 
        $where="ID_utente = ".$this->_authService->getIdentity()->ID_utente;
 
        $this->update($values,$where);
 
    }
 
    

    public function cancellaUtente($utente)
    {
        $where="ID_utente = $utente";
        $this->delete($where);
        
    }

     public function numeroUtenti()
    {
        $rowset   = $this->fetchAll();
 
        $rowCount = count($rowset);
                                
        return  $rowCount;
    }
    
    public function getUtente(){
    
        $select= $this->select();
        
        return $this->fetchAll($select);
    }
    
    public function getStaff(){
    
        $select= $this->select()
                      ->where('role= ?','staff');
        
        return $this->fetchAll($select);
    }
    

}

