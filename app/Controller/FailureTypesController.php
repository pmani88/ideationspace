<?php
// Controller/AttributesController.php
class FailureTypesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $FailureTypes = $this->FailureType->find('all');
        $this->set(compact('FailureTypes'));
		$this->set('_serialize', array('FailureTypes'));
    }

    public function view($id) {
        $FailureType = $this->FailureType->findById($id);
        $this->set(compact('FailureType'));
		$this->set('_serialize', array('FailureType'));
    }

}