<?php

class StaffController extends Zend_Controller_Action
{
    protected $_staffModel;

    protected $_authService;
    protected $_update;
    protected $_publicModel;
    protected $_promo;
    protected $_profilo;
    protected $_updateprofilo;


    public function init()
    {

        $this->_helper->layout->setLayout('staff');
        $this->_staffModel = new Application_Model_Staff();
        $this->view->profiloForm = $this->getProfiloForm();
        $this->view->productForm = $this->getProductForm();
        $this->view->cambiareprofiloForm = $this->getCambiareprofiloForm();
        if ($this->hasParam('codprod'))
            $this->view->modificapromoForm = $this->getModificaPromoForm();
        $this->_authService = new Application_Service_Auth();
        $this->_publicModel = new Application_Model_Public();
    }

    public function indexAction()
    {

    }


//aggiunta promozioni
    public function newproductAction()
    {
    }

    public function addproductAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }

        $form = $this->_promo;


        if (!$form->isValid($_POST)) {
            return $this->render('newproduct');
        }
        $values = $form->getValues();


        $dataInizio = $values['data_inizio'];
        $dataFine = $values['data_fine'];

        $giorno = substr($dataInizio, 0, 2);
        $mese = substr($dataInizio, 3, 2);
        $anno = substr($dataInizio, 6, 4);
        $values['data_inizio'] = "$anno-$mese-$giorno";
        $giorno = substr($dataFine, 0, 2);
        $mese = substr($dataFine, 3, 2);
        $anno = substr($dataFine, 6, 4);
        $values['data_fine'] = "$anno-$mese-$giorno";

        $this->_staffModel->saveProduct($values);


        $this->_helper->redirector('index');

    }

    public function error1Action()
    {

    }

    private function getProductForm()
    {
        $urlHelper = $this->_helper->getHelper('url');

        $this->_promo = new Application_Form_Staff_Product_Modificapromo();
        $this->_promo->setAction($urlHelper->url(array(

            'controller' => 'staff',
            'action' => 'addproduct'),
            'default'
        ));

        return $this->_promo;

    }

    public function modificapromoAction()
    {

    }

    public function modificaAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_update;
        if (!$form->isValid($_POST)) {
            return $this->render('modificapromo');
        }
        $values = $form->getValues();
        $dataInizio = $values['data_inizio'];
        $dataFine = $values['data_fine'];

        $giorno = substr($dataInizio, 0, 2);
        $mese = substr($dataInizio, 3, 2);
        $anno = substr($dataInizio, 6, 4);
        $values['data_inizio'] = "$anno-$mese-$giorno";
        $giorno = substr($dataFine, 0, 2);
        $mese = substr($dataFine, 3, 2);
        $anno = substr($dataFine, 6, 4);
        $values['data_fine'] = "$anno-$mese-$giorno";


        $this->_staffModel->modificaPromo($values, $this->getParam('codprod'));
        $this->_helper->redirector('index');

    }

    private function getModificaPromoForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_update = new Application_Form_Staff_Product_Modificapromo();
        $this->_update->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'modifica'),
            'default'
        ));
        $idprodotto = $this->_getParam('codprod', null);
        $values = $this->_staffModel->getInfoprodotto($idprodotto)->current()->toArray();
        $dataInizio = $values['data_inizio'];
        $dataFine = $values['data_fine'];

        $giorno = substr($dataInizio, 8, 2);
        $mese = substr($dataInizio, 5, 2);
        $anno = substr($dataInizio, 0, 4);
        $values['data_inizio'] = "$giorno-$mese-$anno";
        $giorno = substr($dataFine, 8, 2);
        $mese = substr($dataFine, 5, 2);
        $anno = substr($dataFine, 0, 4);
        $values['data_fine'] = "$giorno-$mese-$anno";
        return $this->_update->populate($values); //popola la form con i valori presenti nel database

    }

    public function cancellaAction()
    {
        $this->_staffModel->cancellaPromo($this->getParam('codprod'));
        $this->_helper->redirector('index');

    }


    //visualizzazione promozioni
    public function visualizzapromoAction()
    {
        $idstaff = $this->_getParam('idstaff', null);
        $order = null;
        $paged = $this->getParam('page', 1);
        $prodotti = $this->_staffModel->getProdsStaff($paged, $idstaff, $order);

        $this->view->assign(array(
                'prodotto' => $prodotti,)
        );


    }


//gestione profilo
    public function profiloAction()
    {

    }

    private function getProfiloForm()
    {

        $urlHelper = $this->_helper->getHelper('url');
        $this->_profilo = new Application_Form_Staff_Profile_Profilo();
        $this->_profilo->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'cambiareprofilo'),
            'default'
        ));
        return $this->_profilo;

    }

    //modifica profilo
    public function cambiareprofiloAction()
    {


    }

    private function getCambiareprofiloForm()
    {

        $urlHelper = $this->_helper->getHelper('url');
        $this->_updateprofilo = new Application_Form_Staff_Profile_Cambiareprofilo();
        $this->_updateprofilo->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'cambia'),
            'default'
        ));
        return $this->_updateprofilo;

    }

    public function cambiaAction()
    {


        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_updateprofilo;

        if (!$form->isValid($_POST)) {
            return $this->render('cambiareprofilo');
        }
        $values = $form->getValues();
        $dataInizio = $values['data_nascita'];
        $giorno = substr($dataInizio, 0, 2);
        $mese = substr($dataInizio, 3, 2);
        $anno = substr($dataInizio, 6, 4);
        $values['data_nascita'] = "$anno-$mese-$giorno";

        $this->_staffModel->modficaUtente($values);
        $this->_helper->redirector('index');


    }

    public function logoutAction()
    {
        $this->_authService->clear();
        return $this->_helper->redirector('index', 'public');
    }

}
