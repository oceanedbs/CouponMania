<?php
class Application_Form_Admin_Utenti_Modificautenti extends Zend_Form
{
	protected $_adminModel;

	public function init()
	{
		
		$this->_adminModel = new Application_Model_Admin();
		$this->setMethod('post');
		$this->setName('modificautenti');
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
            'label' => 'Data Nascita',
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
            'validators' => array(array('StringLength',true, array(1,25))),
		));
            
            
            
           
           $this->addElement('hidden', 'role', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),         
            
            
            ));
           
            
            
           $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
           
            ));
        
        $this->addElement('text', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
           
            ));
            
            $this->addElement('submit', 'modifica', array(
            'label' => 'modifica',
		));
        /*
        $this->ID_utente->setValue($this->utente->ID_utente);
        $this->nome_utente->setValue($this->utente->nome_utente);
        $this->cognome->setValue($this->utente->cognome);
        $this->sesso->setValue($this->utente->sesso);
        $this->data_nascita->setValue($this->utente->data_nascita);
        $this->telefono->setValue($this->utente->telefono);
        $this->email->setValue($this->utente->email);
        $this->role->setValue($this->utente->role);
        $this->username->setValue($this->utente->username);
        $this->password->setValue($this->utente->password);
         */
         $path=APPLICATION_PATH;

$path.= "/services/it/Zend_Validate.php";

$translator = new Zend_Translate(

    array(
        'adapter' => 'array',
        'content' => $path,
        'locale'  => "it_IT",
        'scan' => Zend_Translate::LOCALE_DIRECTORY
    )
);
Zend_Validate_Abstract::setDefaultTranslator($translator);
}
}