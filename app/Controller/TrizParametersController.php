<?php
// Controller/AttributesController.php
class TrizParametersController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $TrizParameters = $this->TrizParameter->find('all');
        $this->set(compact('TrizParameters'));
		$this->set('_serialize', array('TrizParameters'));
    }

    public function view($id) {
        $TrizParameter = $this->TrizParameter->findById($id);
        $this->set(compact('TrizParameter'));
		$this->set('_serialize', array('TrizParameter'));
    }

}