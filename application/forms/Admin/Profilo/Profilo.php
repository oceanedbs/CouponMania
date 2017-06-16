<?php
class Application_Form_Admin_Profilo extends Zend_Form
{

	public function init()
	{
            $this->setMethod('post');
		$this->setName('stampare');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');


            $this->addElement('submit', 'cambiareprofilo', array(
                                'label' => ' Cambiare le Credenziali ',
		));
             echo getcwd();
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