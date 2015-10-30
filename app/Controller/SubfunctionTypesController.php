<?php
// Controller/AttributesController.php
class SubfunctionTypesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $SubfunctionTypes = $this->SubfunctionType->find('all');
        $this->set(compact('SubfunctionTypes'));
		$this->set('_serialize', array('SubfunctionTypes'));
    }

    public function view($id) {
        $SubfunctionType = $this->SubfunctionType->findById($id);
        $this->set(compact('SubfunctionType'));
		$this->set('_serialize', array('SubfunctionType'));
    }

}