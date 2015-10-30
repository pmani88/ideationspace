<?php
// Controller/AttributesController.php
class EquationsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Equations = $this->Equation->find('all');
        $this->set(compact('Equations'));
		$this->set('_serialize', array('Equations'));
    }

    public function view($id) {
        $Equation = $this->Equation->findById($id);
        $this->set(compact('Equation'));
		$this->set('_serialize', array('Equation'));
    }

}