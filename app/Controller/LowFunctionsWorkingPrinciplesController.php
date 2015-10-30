<?php
// Controller/AttributesController.php
class LowFunctionsWorkingPrinciplesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $LowFunctionsWorkingPrinciples = $this->LowFunctionsWorkingPrinciple->find('all');
        $this->set(compact('LowFunctionsWorkingPrinciples'));
		$this->set('_serialize', array('LowFunctionsWorkingPrinciples'));
    }

    public function view($id) {
        $LowFunctionsWorkingPrinciple = $this->LowFunctionsWorkingPrinciple->findById($id);
        $this->set(compact('LowFunctionsWorkingPrinciple'));
		$this->set('_serialize', array('LowFunctionsWorkingPrinciple'));
    }

}