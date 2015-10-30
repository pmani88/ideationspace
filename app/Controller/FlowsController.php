<?php
// Controller/AttributesController.php
class FlowsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Flows = $this->Flow->find('all');
        $this->set(compact('Flows'));
		$this->set('_serialize', array('Flows'));
    }

    public function view($id) {
        $Flow = $this->Flow->findById($id);
        $this->set(compact('Flow'));
		$this->set('_serialize', array('Flow'));
    }

}