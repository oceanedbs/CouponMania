<?php
class Application_Form_Staff_Insertbutton extends Zend_Form
{

	public function init()
	{
            $this->setMethod('post');
		$this->setName('inserisci');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');


            $this->addElement('submit', 'inserisci', array(
                                'label' => 'Inserisci',
		));
		
		
        }
        
        
}