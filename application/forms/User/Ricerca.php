<?php
class Application_Form_User_Ricerca extends Zend_Form
{
	protected $_publicModel;

	public function init()
	{
		$this->_publicModel = new Application_Model_Public();
		$this->setMethod('post');
		$this->setName('ricerca');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

                $paged="";
		$categories = array();
                $categories[0]= '-';
		$cats = $this->_publicModel->getTopCats($paged);
		foreach ($cats as $cat) {
			$categories[$cat -> catId] = $cat->name;
		}		
		$this->addElement('select', 'catId', array(
                                    'label' => 'Categoria',
                                    'multiOptions' => $categories,
                                ));


		$this->addElement('text', 'paroleChiave', array(
                                    'label' => 'Ricerca',
                                    'filters' => array('StringTrim'),
                                    'validators' => array(array('StringLength',true, array(1,30))),
                                ));


		$this->addElement('submit', 'ricerca', array(
                                    'label' => 'Ricerca',
                                ));
                                
                 $this->setDecorators(array( 'FormElements', array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
                                      array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
                                        'Form'
                                        ));
	}
}