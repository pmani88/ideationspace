<?php
// Controller/AttributesController.php
class PhysicalParametersController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $PhysicalParameters = $this->PhysicalParameter->find('all');
        $this->set(compact('PhysicalParameters'));
		$this->set('_serialize', array('PhysicalParameters'));
    }

    public function view($id) {
        $PhysicalParameter = $this->PhysicalParameter->findById($id);
        $this->set(compact('PhysicalParameter'));
		$this->set('_serialize', array('PhysicalParameter'));
    }

}