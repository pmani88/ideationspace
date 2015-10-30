<?php
// Controller/AttributesController.php
class OsuFunctionsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $OsuFunctions = $this->OsuFunction->find('all');
        $this->set(compact('OsuFunctions'));
		$this->set('_serialize', array('OsuFunctions'));
    }

    public function view($id) {
        $OsuFunction = $this->OsuFunction->findById($id);
        $this->set(compact('OsuFunction'));
		$this->set('_serialize', array('OsuFunction'));
    }

}