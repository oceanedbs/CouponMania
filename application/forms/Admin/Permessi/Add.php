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

		
                
                
                
              
		$aziende = array();
                //$azienda=$this->_adminModel->getAziendeStaff($idstaff);
		
		foreach ($aziende as $azi) {
			$aziende[$az ->P_Iva] = $azi->nome;
		}
		$this->addElement('select', 'P_Iva', array(
            'label' => 'Assegna azienda',
            'multiOptions' => $aziende,
		));
                
                $this->addElement('submit', 'add', array(
                       'label' => 'Aggiungi Permesso',
		       ));
        }
}