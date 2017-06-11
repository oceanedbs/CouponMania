<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract
{
    protected $_name    = 'coupon';
    protected $_primary  = 'cod_promozione';
    protected $_rowClass = 'Application_Resource_Coupon_Item';
    protected $_authService;


    public function init()
    {
    }

    public function registraCoupon($data)
    {
         $this->insert($data);
         
    
    }
    

}