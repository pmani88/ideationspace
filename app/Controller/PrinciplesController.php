<?php
// Controller/AttributesController.php
class PrinciplesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Principles = $this->Principle->find('all');
        $this->set(compact('Principles'));
		$this->set('_serialize', array('Principles'));
    }

    public function view($id) {
        $Principle = $this->Principle->findById($id);
        $this->set(compact('Principle'));
		$this->set('_serialize', array('Principle'));
    }

}