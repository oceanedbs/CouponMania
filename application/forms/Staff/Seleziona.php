<?php
class Application_Form_Staff_Seleziona extends Zend_Form
{

	public function init()
	{
            $this->setMethod('post');
		$this->setName('seleziona');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');


            $this->addElement('radio', 'seleziona', array(
                                
		));
		
		
        }
        
        
}
