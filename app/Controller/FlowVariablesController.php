<?php
// Controller/AttributesController.php
class FlowVariablesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $FlowVariables = $this->FlowVariable->find('all');
        $this->set(compact('FlowVariables'));
		$this->set('_serialize', array('FlowVariables'));
    }

    public function view($id) {
        $FlowVariable = $this->FlowVariable->findById($id);
        $this->set(compact('FlowVariable'));
		$this->set('_serialize', array('FlowVariable'));
    }

}