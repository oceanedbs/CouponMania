<?php
class Application_Form_Public_Ricercare_Ricerca extends Zend_Form
{
	protected $_catalogModel;

	public function init()
	{
		$this->_catalogModel = new Application_Model_Catalog();
		$this->setMethod('post');
		$this->setName('ricerca');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

                $paged="";
		$categories = array();
                array_push($categories, "-");
		$cats = $this->_catalogModel->getTopCats($paged);
		foreach ($cats as $cat) {
			$categories[$cat -> catId] = $cat->name;
		}		
		$this->addElement('select', 'catId', array(
                                    'label' => 'Categoria',
                                    'required' => false,
                                    'multiOptions' => $categories,
                                ));


		$this->addElement('text', 'paroleChiave', array(
                                    'label' => 'Ricerca',
                                    'required' => false,
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