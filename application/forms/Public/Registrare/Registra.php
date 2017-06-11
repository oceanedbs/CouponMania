<?php

class Application_Form_Public_Registrare_Registra extends App_Form_Abstract
{
	public function init()
    {               
        $this->setMethod('post');
        $this->setName('authenticatereg');
        $this->setAction('');
        
    	 $this->addElement('text', 'nome', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),
            'required'   => true,
            'label'      => 'Nome',
            'decorators' => $this->elementDecorators,
            ));
         
          $this->addElement('text', 'cognome', array(
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
            'multiOptions' => array('m' => 'M', 'f' => 'F'),
               'decorators' => $this->elementDecorators,
		));
           
           $this->addElement('text', 'data_nascita', array(
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
           
           $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 50),
                 'EmailAddress' )
            ),
            'required'   => true,
            'label'      => 'E-mail',
            'decorators' => $this->elementDecorators,
            ));
           
           $this->addElement('hidden', 'role', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),         
            
            'value'      =>'user',
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
        
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators,
            ));

        $this->addElement('submit', 'registra', array(
            'label'    => 'Registrati',
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
