<?php

class Application_Resource_Product_Item extends Zend_Db_Table_Row_Abstract
{       
    public function getPrice($withDiscount=false)
    {
    	$price = $this->price;
    	if (true == $this->isDiscounted() && true == $withDiscount) {
            $discount = $this->discountPerc;
            $discounted = ($price*$discount)/100;
            $price = round($price - $discounted, 2);
        }
        return $price;
    }
    
    private function isDiscounted()
    {
        return 0 == $this->discountPerc ? false : true;       
    }
    
}