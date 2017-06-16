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
