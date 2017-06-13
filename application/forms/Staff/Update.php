<?php
class Application_Form_Staff_Update extends Zend_Form
{

	public function init()
	{
            $this->setMethod('post');
		$this->setName('update');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');


            $this->addElement('submit', 'modifica', array(
                                'label' => 'Modifica Promozione',
		));
		
		
        }
        
        
}