<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract
{
    protected $_name    = 'coupon';
    protected $_primary  = 'cod_promozione';
    protected $_rowClass = 'Application_Resource_Coupon_Item';


    public function init()
    {
    }

    public function registraCoupon($data)
    {
         $this->insert($data);
    }
    
    public function verificareCoupon($idprodotto, $idutente)
    {
        $select = $this ->select()
                        ->where ('ID_utente = ?', $idutente)
                        ->where('cod_promozione = ?', $idprodotto);
        $result = $this->fetchRow($select);
        if(!empty($result)){
            return 0;
        }
        else {
            return 1;
        }
        
    }
    public function numeroCoupon()
    {
        $select=$this->select();
        
        $countRowsSelect = $this->getAdapter()->select()
                                ->from(array('cnt' => $select), array('row_count' => 'COUNT(*)'));
                                
        return  $countRowsSelect->query()->fetchAll();
    }
    

}