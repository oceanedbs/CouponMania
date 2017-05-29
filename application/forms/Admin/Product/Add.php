<?php
class Application_Form_Admin_Product_Add extends Zend_Form
{
	protected $_adminModel;

	public function init()
	{
		$this->_adminModel = new Application_Model_Admin();
		$this->setMethod('post');
		$this->setName('addproduct');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

		$this->addElement('text', 'name', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => 'testo di descrizione',
            'validators' => array(array('StringLength',true, array(1,25))),
		));

		$categories = array();
		$cats = $this->_adminModel->getSubCats();
		foreach ($cats as $cat) {
			$categories[$cat -> catId] = $cat->name;
		}
		$this->addElement('select', 'catId', array(
            'label' => 'Categoria',
            'required' => true,
			'multiOptions' => $categories,
		));

		$this->addElement('file', 'image', array(
			'label' => 'Immagine',
			'destination' => APPLICATION_PATH . '/../public/images/products',
			'validators' => array( 
			array('Count', false, 1),
			array('Size', false, 102400),
			array('Extension', true, array('jpg', 'gif'))),
			));

		$this->addElement('text', 'descShort', array(
            'label' => 'Descrizione Breve',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength',true, array(1,30))),
		));

		$this->addElement('text', 'price', array(
            'label' => 'Prezzo',
            'required' => true,
            'filters' => array('LocalizedToNormalized'),
            'validators' => array(array('Float', true, array('locale' => 'en_US'))),
		));

		$this->addElement('text', 'discountPerc',array(
            'label' => 'Sconto (%)',
            'value' => 0,
            'required' => true,
            'validators' => array('Int'),
		));

		$this->addElement('select', 'discounted', array(
            'label' => 'In Sconto',
            'multiOptions' => array('1' => 'Si', '0' => 'No'),
		));

		$this->addElement('textarea', 'descLong', array(
            'label' => 'Descrizione Estesa',
        		'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
		));

		$this->addElement('submit', 'add', array(
            'label' => 'Aggiungi Prodotto',
		));
	}
}