<?php
class Application_Form_Admin_Category_Modificacategory extends Zend_Form
{
	protected $_adminModel;

	public function init()
	{
		
		$this->_adminModel = new Application_Model_Admin();
		$this->setMethod('post');
		$this->setName('modificacategory');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

		
                
                $this->addElement('text', 'name', array(
            'label' => 'Nome Categoria',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
                
                $this->addElement('text', 'desc', array(
            'label' => 'Descrizione',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength',true, array(1,50))),
		));
                
                $this->addElement('select', 'parId', array(
            'label' => 'Tipo Categoria',
            'multiOptions' => array('0' => 'classificazione', '1' => 'sconto'),
		));
                
                $this->addElement('file', 'image', array(
			'label' => 'Immagine',
			'destination' => APPLICATION_PATH . '/../public/images/aziende',
			'validators' => array( 
			//array('Count', false, 1),
			array('Size', false, 102400),
			array('Extension', true, array('jpg', 'gif','png'))),
			));
                
                 $this->addElement('file', 'logo', array(
			'label' => 'Logo',
			'destination' => APPLICATION_PATH . '/../public/images/aziende',
			'validators' => array( 
			//array('Count', false, 1),
			array('Size', false, 102400),
			array('Extension', true, array('jpg', 'gif','png'))),
			));
               
            
                $this->addElement('submit', 'add', array(
                       'label' => 'Aggiungi Categoria',
		       ));
                
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