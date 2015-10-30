<?php
// Controller/AttributesController.php
class IdeationMethodsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $IdeationMethods = $this->IdeationMethod->find('all');
        $this->set(compact('IdeationMethods'));
		$this->set('_serialize', array('IdeationMethods'));
    }

    public function view($id) {
        $IdeationMethod = $this->IdeationMethod->findById($id);
        $this->set(compact('IdeationMethod'));
		$this->set('_serialize', array('IdeationMethod'));
    }

}