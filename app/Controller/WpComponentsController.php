<?php
// Controller/AttributesController.php
class WpComponentsController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}
	
	public function index() {
        $WpComponents = $this->WpComponent->find('all');
        $this->set(compact('WpComponents'));
		$this->set('_serialize', array('WpComponents'));
    }

    public function view($id) {
        $WpComponent = $this->WpComponent->findById($id);
        $this->set(compact('WpComponent'));
		$this->set('_serialize', array('WpComponent'));
    }

}