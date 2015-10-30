<?php
// Controller/AttributesController.php
class MiniStrategiesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $MiniStrategies = $this->MiniStrategy->find('all');
        $this->set(compact('MiniStrategies'));
		$this->set('_serialize', array('MiniStrategies'));
    }

    public function view($id) {
        $MiniStrategy = $this->MiniStrategy->findById($id);
        $this->set(compact('MiniStrategy'));
		$this->set('_serialize', array('MiniStrategy'));
    }

}