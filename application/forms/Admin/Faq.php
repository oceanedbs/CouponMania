<?php
class Application_Form_Admin_Faq extends Zend_Form
{
	

	public function init()
	{
		
		
		$this->setMethod('post');
		$this->setName('modificafaq');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

		
                
                $this->addElement('textarea', 'domanda', array(
            'label' => 'Domanda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,200))),
		));
                
                  $this->addElement('textarea', 'risposta', array(
            'label' => 'Risposta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,200))),
		));
                    
               
                
            $this->addElement('submit', 'modifica', array(
            'label' => 'Invia',
                ));
        
	
         
}
}

?>