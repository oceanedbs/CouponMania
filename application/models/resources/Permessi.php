<?php

class Application_Resource_Permessi extends Zend_Db_Table_Abstract
{
    protected $_name    = 'permessi';
    protected $_primary  = 'ID_utente';
    protected $_rowClass = 'Application_Resource_Permessi_Item';
   // protected $_authService;

    
    public function savepermesso($idstaff, $values)
    {
    	$select=$this->select()
                    ->where('ID_utente IN (?)', $idstaff)
                    ->where('P_Iva IN (?)',$values);
    	
    	 $result=$this->fetchRow($select);
    	 
    	  if(!empty($result)){
    	  
            return 1;
            }
            else {
            
            $data=array('ID_utente' => $idstaff,
                         'P_Iva' => $values,
                        );
    	
            $this->insert($data);
    	}
    }
    
    public function modificapermessi($values,$idper)
    {
        $where="ID_utente = $idper";
        $this->update($values,$where);
    }
    
    public function getInfoPermessi($idutente)
    {
        $select=$this->select()->from('permessi')
                               ->where('permessi.ID_utente= ?',$idutente)
                               ->join('aziende', 'permessi.P_Iva=aziende.P_Iva')
                               ->join('utente', 'permessi.ID_utente=utente.ID_utente')
                               ->setIntegrityCheck(false);
         return $this->fetchAll($select);
    }
    
    public function cancellaPermessi($idutente,$idazienda)
    {$where="ID_utente = $idutente AND P_Iva = $idazienda";
     
        $this->delete($where);
             
    }
    
   
   
    
    
    
    
    
}