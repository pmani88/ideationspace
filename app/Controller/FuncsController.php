<?php
// Controller/AttributesController.php
class FuncsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $Funcs = $this->Func->find('all');
        $this->set(compact('Funcs'));
		$this->set('_serialize', array('Funcs'));
    }

    public function view($id) {
        $Func = $this->Func->findById($id);
        $this->set(compact('Func'));
		$this->set('_serialize', array('Func'));
    }

}