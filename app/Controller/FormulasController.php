<?php
// Controller/AttributesController.php
class FormulasController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Formulas = $this->Formula->find('all');
        $this->set(compact('Formulas'));
		$this->set('_serialize', array('Formulas'));
    }

    public function view($id) {
        $Formula = $this->Formula->findById($id);
        $this->set(compact('Formula'));
		$this->set('_serialize', array('Formula'));
    }

}