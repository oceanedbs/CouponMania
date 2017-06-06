<?php
class Application_Form_Public_Contact_Contact extends Zend_Form
{

	public function init()
	{
		$this->setMethod('post');
		$this->setName('contactus');
		$this->setAction('');

		$this->addElement('text', 'name', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'description' => 'testo di descrizione',
            'validators' => array(array('StringLength',true, array(1,25))),
		));

		
		$this->addElement('text', 'email', array(
            'label' => 'Email',
            'filters' => array('StringTrim'),
            'required' => true,
            'description' => 'testo di descrizione',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
		
		$this->addElement('text', 'telefono', array(
            'label' => 'telefono',
            'filters' => array('StringTrim'),
            'required' => true,
            'description' => 'testo di descrizione',
            'validators' => array(array('StringLength',true, array(8,12))),
		));
		

		$this->addElement('textarea', 'messaggio', array(
            'label' => 'Messaggio',
            'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
		));

		$this->addElement('submit', 'inviare', array(
            'label' => 'Inviare',
		));
		
	}
} 
