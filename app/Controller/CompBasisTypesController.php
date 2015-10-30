<?php
// Controller/AttributesController.php
class CompBasisTypesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $CompBasisTypes = $this->CompBasisType->find('all');
        $this->set(compact('CompBasisTypes'));
		$this->set('_serialize', array('CompBasisTypes'));
    }

    public function view($id) {
        $CompBasisType = $this->CompBasisType->findById($id);
        $this->set(compact('CompBasisType'));
		$this->set('_serialize', array('CompBasisType'));
    }

}