<?php
class Application_Form_Admin_Permessi_Add extends Zend_Form
{
	protected $_adminModel;

	public function init()
	{
		
		$this->_adminModel = new Application_Model_Admin();
		$this->setMethod('post');
		$this->setName('newstaffpermessi');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

              
              
		$page=null;
		$aziende = array();
		$azi = $this->_adminModel->getAziende($page);
		foreach ($azi as $az) {
			$aziende[$az -> P_Iva] = $az->nome;
		}
		$this->addElement('select', 'P_Iva', array(
                    'label' => 'Assegna azienda',
                    'multiOptions' => $aziende,
		));
                
                $this->addElement('submit', 'add', array(
                       'label' => 'Aggiungi Permesso',
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