<?php
// Controller/AttributesController.php
class VerbsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Verbs = $this->Verb->find('all');
        $this->set(compact('Verbs'));
		$this->set('_serialize', array('Verbs'));
    }

    public function view($id) {
        $Verb = $this->Verb->findById($id);
        $this->set(compact('Verb'));
		$this->set('_serialize', array('Verb'));
    }

}