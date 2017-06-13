<?php
class Application_Form_Admin_Aziende_Modificaaziende extends Zend_Form
{
	protected $_adminModel;

	public function init()
	{
		
		$this->_adminModel = new Application_Model_Admin();
		$this->setMethod('post');
		$this->setName('modificaaziende');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

		$this->addElement('text', 'P_Iva', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(1, 12))
            ),
                    'required'   => true,
            'label'      => 'Partita Iva',
            ));
                
                $this->addElement('text', 'nome', array(
            'label' => 'Nome Azienda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
                
                $this->addElement('file', 'logo', array(
			'label' => 'Logo',
			'destination' => APPLICATION_PATH . '/../public/images/aziende',
			'validators' => array( 
			//array('Count', false, 1),
			array('Size', false, 102400),
			array('Extension', true, array('jpg', 'gif'))),
			));
                
                $this->addElement('text', 'indirizzo', array(
            'label' => 'Indirizzo',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength',true, array(1,50))),
		));
                
               
                
               
                
            $this->addElement('text', 'citta', array(
            'label' => 'Citta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
                
            
            
            $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength',true, array(1,300))),
		));
            
            $this->addElement('submit', 'modifica', array(
            'label' => 'modifica',
		));
        /*
        $this->P_Iva->setValue($this->azienda->P_Iva);
        $this->nome->setValue($this->azienda->nome);
        $this->logo->setValue($this->azienda->logo);
        $this->citta->setValue($this->azienda->citta);
        $this->indirizzo->setValue($this->azienda->indirizzo);
        $this->tipologia->setValue($this->azienda->tipologia);
        $this->descrizione->setValue($this->azienda->descrizione);
         */
         
}
}