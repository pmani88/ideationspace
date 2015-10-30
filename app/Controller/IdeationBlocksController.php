<?php
// Controller/AttributesController.php
class IdeationBlocksController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $IdeationBlocks = $this->IdeationBlock->find('all');
        $this->set(compact('IdeationBlocks'));
		$this->set('_serialize', array('IdeationBlocks'));
    }

    public function view($id) {
        $IdeationBlock = $this->IdeationBlock->findById($id);
        $this->set(compact('IdeationBlock'));
		$this->set('_serialize', array('IdeationBlock'));
    }

}