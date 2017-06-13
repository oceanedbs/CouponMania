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
    public function insertUtente($info)
    {
    	$this->insert($info);
    }
    
    public function insertStaff($info)
    {
    	$this->insert($info);
    }
    
    public function getInfoUtente()
    {
        $username= $this->_authService->getIdentity()->username;
        return $this->fetchRow($this->select()->where('username = ?',$username));
    }
    
    public function modificaUtente($values)
    {
        $where="ID_utente = ".$this->_authService->getIdentity()->ID_utente;
        $this->update($values,$where);
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
    
}

