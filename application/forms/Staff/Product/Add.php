<?php
class Application_Form_Staff_Product_Add extends Zend_Form
{
	protected $_staffModel;

	public function init()
	{
		$this->_staffModel = new Application_Model_Staff();
		$this->setMethod('post');
		$this->setName('addproduct');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

		$this->addElement('text', 'prodotto', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
        		
            'validators' => array(array('StringLength',true, array(1,25))),
		));
                $page='';
		$categories = array();
		$cats = $this->_staffModel->getTopCats($page);
		foreach ($cats as $cat) {
			$categories[$cat -> catId] = $cat->name;
		}
		$this->addElement('select', 'tipo_prom', array(
            'label' => 'Categoria',
            'required' => true,
			'multiOptions' => $categories,
		));
                $page='';
		$categories = array();
		$cats = $this->_staffModel->getTopOfferte($page);
		foreach ($cats as $cat) {
			$categories[$cat -> catId] = $cat->name;
		}
		$this->addElement('select', 'catId', array(
            'label' => 'Tipo offerta',
            'multiOptions' => $categories,
		));
                
                $page='';
		$aziende = array();
		$aznd = $this->_staffModel->getAziende($page);
		foreach ($aznd as $azi) {
			$aziende[$azi -> P_Iva] = $azi->nome;
		}
		$this->addElement('select', 'P_Iva', array(
            'label' => 'Azienda',
            'required' => true,
			'multiOptions' => $aziende,
		));
		$this->addElement('file', 'immagine', array(
			'label' => 'Immagine',
			'destination' => APPLICATION_PATH . '/../public/images/products',
			'validators' => array( 
			//array('Count', false, 1),
			array('Size', false, 102400),
			array('Extension', true, array('jpg', 'gif'))),
			));

		$this->addElement('text', 'descrizione', array(
            'label' => 'Descrizione Breve',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength',true, array(1,30))),
		));

		$this->addElement('text', 'prezzo_unitario_prod', array(
            'label' => 'Prezzo',
            'required' => true,
            'filters' => array('LocalizedToNormalized'),
            'validators' => array(array('Float', true, array('locale' => 'en_US'))),
		));

		
                

		$this->addElement('text', 'data_inizio', array(
            'label' => 'Data inizio (gg-mm-aaaa)',
            'filters' => array('LocalizedToNormalized'),            
            'required' => true,
            'validators' => array(),
		));
                
                $this->addElement('text', 'data_fine', array(
            'label' => 'Data fine (gg-mm-aaaa)',
            'filters' => array('LocalizedToNormalized'),            
            'required' => true,
            'validators' => array(),
		));

		$this->addElement('submit', 'add', array(
            'label' => 'Aggiungi Prodotto',
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