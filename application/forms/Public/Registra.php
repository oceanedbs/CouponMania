<?php

class Application_Form_Public_Registra extends App_Form_Abstract
{
	public function init()
    {               
        $this->setMethod('post');
        $this->setName('registra');
        $this->setAction('');
        
    	 $this->addElement('text', 'name', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),
            'required'   => true,
            'label'      => 'Nome',
            'decorators' => $this->elementDecorators,
            ));
         
          $this->addElement('text', 'surname', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),
            'required'   => true,
            'label'      => 'Cognome',
            'decorators' => $this->elementDecorators,
            ));
          
           $this->addElement('select', 'sesso', array(
            'label' => 'Sesso',
                'required'   => true,
            'multiOptions' => array('1' => 'M', '0' => 'F'),
               'decorators' => $this->elementDecorators,
		));
           
           $this->addElement('text', 'datanas', array(
            'label' => 'Data di nascita',
                'required'   => true,
            'placeholder'=>'aaaa-mm-gg',
               'decorators' => $this->elementDecorators,
		));
           $this->addElement('text', 'telefono', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 10))
            ),
                'required'   => true,
            'label'      => 'Telefono',
            'decorators' => $this->elementDecorators,
            ));
           
           $this->addElement('text', 'citta', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),         
            'label'      => 'Città',
            'decorators' => $this->elementDecorators,
            ));
           
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('password', 'passwd', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators,
            ));

        $this->addElement('submit', 'login', array(
            'label'    => 'Login',
            'decorators' => $this->buttonDecorators,
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
        		array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
