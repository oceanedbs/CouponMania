<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'faq';
    protected $_primary  = 'id_faq';
    protected $_rowClass = 'Application_Resource_Faq_Item';

	public function init()
    {
    }
    
 
    
    public function getFaq($paged)
    {
        $select = $this->select();
        
        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(3)
                        ->setCurrentPageNumber((int) $paged);
            return $paginator;
            }
               
        return $this->fetchAll($select);       
    } 
    
    public function modificafaq($values,$idfaq)
    {
        $where="id_faq=$idfaq";
        $this->update($values,$where);
    }
     public function getInfoFaq($idfaq){
    
        return $this->find($idfaq);
     }
     public function cancellafaq($idfaq)
     {  $where="id_faq= $idfaq";
         return $this->delete($where);
     }
     
     public function insertfaq($values){
         $this->insert($values);
     }
    }
?>