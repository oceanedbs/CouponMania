<?php
class Zend_View_Helper_AddContactForm extends Zend_View_Helper_Abstract()
{

    public function addContactForm(){
        return  new Zend_Form_ContactForm();
    
    }
	
}