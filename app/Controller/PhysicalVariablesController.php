<?php
// Controller/AttributesController.php
class PhysicalVariablesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $PhysicalVariables = $this->PhysicalVariable->find('all');
        $this->set(compact('PhysicalVariables'));
		$this->set('_serialize', array('PhysicalVariables'));
    }

    public function view($id) {
        $PhysicalVariable = $this->PhysicalVariable->findById($id);
        $this->set(compact('PhysicalVariable'));
		$this->set('_serialize', array('PhysicalVariable'));
    }

}