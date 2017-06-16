<?php
class Application_Form_Admin_Staff_Add extends Zend_Form
{
	protected $_adminModel;

	public function init()
	{
		$this->_adminModel = new Application_Model_Admin();
		$this->setMethod('post');
		$this->setName('addstaff');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

		$this->addElement('text', 'nome_utente', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
                
                $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
                
               $this->addElement('select', 'sesso', array(
            'label' => 'Sesso',
                'required'   => true,
            'multiOptions' => array('m' => 'M', 'f' => 'F'),
		));
                
                 $this->addElement('text', 'data_nascita', array(
            'label' => 'Data Nascita (yyyy-mm-gg)',
            'filters' => array('LocalizedToNormalized'),            
            'required' => true,
            'validators' => array(),
		));
                 
            $this->addElement('text', 'citta', array(
            'label' => 'Citta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
                
                $this->addElement('text', 'telefono', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 10))
            ),
                'required'   => true,
            'label'      => 'Telefono',
            ));
            
              
            $this->addElement('text', 'email', array(
            'label' => 'E-mail',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,40))),
		));
            
            
            
           
           $this->addElement('hidden', 'role', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),         
            
            'value'      =>'staff',
            ));
           
            
            
           $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
           
            ));
        
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
           
            ));
                

		$this->addElement('submit', 'add', array(
            'label' => 'Aggiungi Staff',
		));
                
                 
	}
}