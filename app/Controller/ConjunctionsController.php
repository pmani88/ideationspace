<?php
// Controller/AttributesController.php
class ConjunctionsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Conjunctions = $this->Conjunction->find('all');
        $this->set(compact('Conjunctions'));
		$this->set('_serialize', array('Conjunctions'));
    }

    public function view($id) {
        $Conjunction = $this->Conjunction->findById($id);
        $this->set(compact('Conjunction'));
		$this->set('_serialize', array('Conjunction'));
    }

}