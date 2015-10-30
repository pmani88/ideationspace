<?php
// Controller/AttributesController.php
class FlowTypesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $FlowTypes = $this->FlowType->find('all');
        $this->set(compact('FlowTypes'));
		$this->set('_serialize', array('FlowTypes'));
    }

    public function view($id) {
        $FlowType = $this->FlowType->findById($id);
        $this->set(compact('FlowType'));
		$this->set('_serialize', array('FlowType'));
    }

}