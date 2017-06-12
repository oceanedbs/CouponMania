<?php

class Application_Resource_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'user';
    protected $_primary  = 'usrId';
    protected $_rowClass = 'Application_Resource_User_Item';
	
	public function init()
    {
    }
       
    public function getUserByName($usrName)
    {
        return $this->fetchRow($this->select()->where('username = ?', $usrName));
    }	
}

