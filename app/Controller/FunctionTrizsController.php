<?php
// Controller/AttributesController.php
class FunctionTrizsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $FunctionTrizs = $this->FunctionTriz->find('all');
        $this->set(compact('FunctionTrizs'));
		$this->set('_serialize', array('FunctionTrizs'));
    }

    public function view($id) {
        $FunctionTriz = $this->FunctionTriz->findById($id);
        $this->set(compact('FunctionTriz'));
		$this->set('_serialize', array('FunctionTriz'));
    }

	public function get_principles($function_id){
		$FunctionTrizs = $this->FunctionTriz->find('all', array('conditions' => array('FunctionTriz.func_id' => $function_id)));
        $this->set(compact('FunctionTrizs'));
		$this->set('_serialize', array('FunctionTrizs'));
	}

}