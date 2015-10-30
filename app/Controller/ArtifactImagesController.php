<?php
// Controller/AttributesController.php
class ArtifactImagesController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	        $this->Auth->allow('*');
	}

    public function index() {
        $ArtifactImages = $this->ArtifactImage->find('all');
        $this->set(compact('ArtifactImages'));
		$this->set('_serialize', array('ArtifactImages'));
    }

    public function view($id) {
        $ArtifactImage = $this->ArtifactImage->findById($id);
        $this->set(compact('ArtifactImage'));
		$this->set('_serialize', array('ArtifactImage'));
    }

}