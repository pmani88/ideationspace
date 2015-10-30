<?php
// Controller/AttributesController.php
class FailuresController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Failures = $this->Failure->find('all');
        $this->set(compact('Failures'));
		$this->set('_serialize', array('Failures'));
    }

    public function view($id) {
        $Failure = $this->Failure->findById($id);
        $this->set(compact('Failure'));
		$this->set('_serialize', array('Failure'));
    }

}