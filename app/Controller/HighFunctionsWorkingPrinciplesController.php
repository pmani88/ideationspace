<?php
// Controller/AttributesController.php
class HighFunctionsWorkingPrinciplesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $HighFunctionsWorkingPrinciples = $this->HighFunctionsWorkingPrinciple->find('all');
        $this->set(compact('HighFunctionsWorkingPrinciples'));
		$this->set('_serialize', array('HighFunctionsWorkingPrinciples'));
    }

    public function view($id) {
        $HighFunctionsWorkingPrinciple = $this->HighFunctionsWorkingPrinciple->findById($id);
        $this->set(compact('HighFunctionsWorkingPrinciple'));
		$this->set('_serialize', array('HighFunctionsWorkingPrinciple'));
    }

}