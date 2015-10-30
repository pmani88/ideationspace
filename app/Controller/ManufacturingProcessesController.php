<?php
// Controller/AttributesController.php
class ManufacturingProcessesController extends AppController {
	
	public $components = array('RequestHandler');

	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $ManufacturingProcesses = $this->ManufacturingProcess->find('all');
        $this->set(compact('ManufacturingProcesses'));
		$this->set('_serialize', array('ManufacturingProcesses'));
    }

    public function view($id) {
        $ManufacturingProcess = $this->ManufacturingProcess->findById($id);
        $this->set(compact('ManufacturingProcess'));
		$this->set('_serialize', array('ManufacturingProcess'));
    }

}