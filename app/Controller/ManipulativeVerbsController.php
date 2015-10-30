<?php
// Controller/AttributesController.php
class ManipulativeVerbsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $ManipulativeVerbs = $this->ManipulativeVerb->find('all');
        $this->set(compact('ManipulativeVerbs'));
		$this->set('_serialize', array('ManipulativeVerbs'));
    }

    public function view($id) {
        $ManipulativeVerb = $this->ManipulativeVerb->findById($id);
        $this->set(compact('ManipulativeVerb'));
		$this->set('_serialize', array('ManipulativeVerb'));
    }

}