<?php
// Controller/AttributesController.php
class ManufacturingProcessTypesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $ManufacturingProcessTypes = $this->ManufacturingProcessType->find('all');
        $this->set(compact('ManufacturingProcessTypes'));
		$this->set('_serialize', array('ManufacturingProcessTypes'));
    }

    public function view($id) {
        $ManufacturingProcessType = $this->ManufacturingProcessType->findById($id);
        $this->set(compact('ManufacturingProcessType'));
		$this->set('_serialize', array('ManufacturingProcessType'));
    }

}