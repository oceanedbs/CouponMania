<?php
class Application_Form_Staff_Product_Modificapromo extends Zend_Form
{
	protected $_staffModel;

	public function init()
	{
		
		$this->setMethod('post');
		$this->setName('modificapromo');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');
            $this->_staffModel = new Application_Model_Staff();
            
            
		
             //   $this->addElement('hidden', 'cod_promozione');
		
                
                
		$this->addElement('text', 'prodotto', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
        		
            'validators' => array(array('StringLength',true, array(1,25))),
		));
                $page=null;
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
            'label' => 'Data inizio',
            'filters' => array('LocalizedToNormalized'),            
            'required' => true,
            'validators' => array(),
		));
                
                $this->addElement('text', 'data_fine', array(
            'label' => 'Data fine',
            'filters' => array('LocalizedToNormalized'),            
            'required' => true,
            'validators' => array(),
		));

		$this->addElement('submit', 'modifica', array(
            'label' => 'Modifica Prodotto',
		));
	
        /*
        $this->prodotto->setValue($this->prodotto->prodotto);
        $this->tipo_prom->setValue($this->prodotto->tipo_prom);
        $this->catId->setValue($this->prodotto->catId);
        $this->P_Iva->setValue($this->prodotto->P_Iva);
        $this->immagine->setValue($this->prodotto->immagine);
        $this->descrizione->setValue($this->prodotto->descrizione);
        $this->prezzo_unitario_prod->setValue($this->prodotto->prezzo_unitario_prod);
        $this->data_inizio->setValue($this->prodotto->data_inizio);
        $this->data_fine->setValue($this->prodotto->data_fine);
         */
         
}
}